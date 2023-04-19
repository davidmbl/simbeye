<?php

namespace App\Http\Controllers;

use App\Models\MasterSetting;
use App\Models\Simbeye as ModelsSimbeye;
use App\Models\SimbeyeScans;
use Carbon\Carbon;
use PDF;

class SimbeyeController extends Controller
{
    //
    public function rfidView($id)
    {
        $rfid = ModelsSimbeye::find($id);
        if (!$rfid) {
            return redirect()->back();
        }
        return view('simbeye.rfid-view', compact(['id']));
    }

    public function rfidAdd()
    {
        return view('simbeye.rfid-add');
    }

    public function scanCard($cardNo)
    {
        $rfid = ModelsSimbeye::where('card_no', $cardNo)->first();
        if (!$rfid) {
            $scan = MasterSetting::where('code_name', 'rfid_to_register')->first();
            $scan->value = $cardNo;
            $scan->save();
            return response()->json(['status' => false, 'message' => 'Unrecognized']);
        }
        //check if card is blocked
        if ($rfid->blocked) {
            return response()->json(['status' => false, 'message' => 'Blocked']);
        }
        //check if card has enough money
        $cost = intval(MasterSetting::where('code_name', 'simbeye_cost')->first()->value);
        if ($rfid->amount >= $cost) {
            SimbeyeScans::create([
                'rfid_id' => $rfid->id,
                'amount' => $cost,
            ]);
            $rfid->amount = $rfid->amount - $cost;
            $rfid->usage = ++$rfid->usage;
            $rfid->last_used = Carbon::now();
            $rfid->save();

            return response()->json(['status' => true, 'message' => 'Success']);
        } else {
            return response()->json(['status' => false, 'message' => 'Low Balance']);
        }
    }

    public function dashboard()
    {

        //scans
        $simbeyes = SimbeyeScans::orderBy('created_at')->get()->groupBy(
            function ($value) {
                return Carbon::parse($value->created_at)->format('D d/M/y');
            }
        );
        $days = [];
        $usage = [];
        foreach ($simbeyes as $key => $search) {
            $days[] = $key;
            $usage[] = $search->count();
        }
        // $scans = new MyChart;
        // $scans->labels($days);
        // $scans->dataset('RFID usage', 'bar', $usage)->backgroundColor('#10351a6f');

        //amount
        $simbeyes = SimbeyeScans::all()->groupBy(
            function ($value) {
                return Carbon::parse($value->created_at)->format('D d/M');
            }
        );
        $days = [];
        $usage = [];
        foreach ($simbeyes as $key => $search) {
            $days[] = $key;
            $usage[] = $search->sum('amount');
        }
        // $collections = new MyChart;
        // $collections->labels($days);
        // $collections->dataset('Payment Collections (Tsh)', 'line', $usage)->backgroundColor('#10351a6f');

        //Monthly Scans
        // $searches = ModelsSimbeye::all()->groupBy(
        //     function ($value) {
        //         return Carbon::parse($value->created_at)->format('M/y');
        //     }
        // );
        // $months = [];
        // $searchsMonth = [];
        // foreach ($searches as $key => $search) {
        //     $months[] = $key;
        //     $searchsMonth[] = $search->count();
        // }
        // $chart = new MyChart;
        // $chart->labels($months);
        // $chart->dataset('Usage', 'line', $searchsMonth)->backgroundColor('#10351a6f');

        $payload = [
            "users" => ModelsSimbeye::count(),
            "total" => SimbeyeScans::sum('amount'),
            "today" => SimbeyeScans::whereDate('created_at', Carbon::today())->count(),
            "todayAmount" => SimbeyeScans::whereDate('created_at', Carbon::today())->sum('amount'),
        ];

        return view('simbeye.admin-dashboard', compact('payload'));
    }

    public function management()
    {
        return view('simbeye.rfid-management');
    }

    public function downloadPdf($payload)
    {
        $data = json_decode(decrypt($payload), true);
        $start = Carbon::parse($data['startDate']);
        $end = Carbon::parse($data['endDate']);
        $reportType = $data['reportType'];

        if ($reportType == 'd') {
            $interval = 'Daily';
        } elseif ($reportType == 'w') {
            $interval = 'Weekly';
        } elseif ($reportType == 'm') {
            $interval = 'Monthly';
        }
        $reportType = $reportType;
        $rfidScans = SimbeyeScans::whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->orderBy('created_at')->get()->groupBy(
            function ($value) use ($reportType) {
                if ($reportType == 'd') {
                    return Carbon::parse($value->created_at)->format('D d/M/y');
                } elseif ($reportType == 'w') {
                    return Carbon::parse($value->created_at)->weekOfMonth . ' week-' . Carbon::parse($value->created_at)->format('M/y');
                } elseif ($reportType == 'm') {
                    return Carbon::parse($value->created_at)->format('M/y');
                }
            }
        );
        if ($rfidScans->count() < 1) {
            dd("No Records");
        }
        $scans = 0;
        $collections = 0;
        $labels = [];
        $dataCollections = [];
        $dataCollectionsAv = [];
        foreach ($rfidScans as $index => $scan) {
            $scans += $scan->count();
            $collections += $scan->sum('amount');
            $labels[] = $index;
            $dataCollections[] = $scan->sum('amount');
            $dataCollectionsAv[] = $scan->average('amount');
        }

        // dd(['collections'=>$dataCollections,'average'=>$dataCollectionsAv]);
        $interval_count = $rfidScans->count();
        $averageScans = $scans / $interval_count;
        $averageCollections = $collections / $interval_count;
        $summaries = [
            'Total Scans' => number_format($scans),
            'Average Scans ' . $interval => number_format($averageScans, 1),
            'Total Collections' => number_format($collections, 1) . ' Tsh',
            'Average Collections ' . $interval => number_format($averageCollections, 1) . ' Tsh',
        ];

        $dates['startDateName'] = $start->format('d-M,y');
        $dates['endDateName'] = $end->format('d-M,y');

        $chartConfig = "{
            type: 'bar',
            data: {
              labels: " . json_encode($labels) . ",
              datasets: [
                {
                  type: 'line',
                  label: 'Collections',
                  borderColor: 'rgb(54, 162, 235)',
                  borderWidth: 1,
                  fill: true,
                  data:" . json_encode($dataCollections) . ",
                }
              ],
            },
            options: {
              title: {
                display: true,
                text: 'Collections Summary Chart',
              },
            },
          }";
        $chartUrl = 'https://quickchart.io/chart?w=500&h=300&c=' . urlencode($chartConfig);

        $pdfName = 'RFID Report (' . $dates['startDateName'] . ' To ' . $dates['endDateName'] . ').pdf';
        $file = PDF::loadView('simbeye.exports.simbeye-pdf', compact('rfidScans', 'chartUrl', 'dates', 'summaries', 'interval'))
            ->setPaper('a4', 'portrait')
            ->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $file->download($pdfName);
    }

    public function report()
    {
        return view('simbeye.report');
    }

}
