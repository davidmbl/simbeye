<?php

namespace App\Http\Livewire\Simbeye;

use App\Models\SimbeyeScans;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use PDF;


class Report extends Component
{
    use WithFileUploads;

    //inputs
    public $startDate;
    public $endDate;
    public $reportType;

    //error
    public $showIntervalError = false;
    public $showStartError = false;
    public $showEndError = false;
    public $showDateError = false;

    public function render()
    {
        return view('livewire.simbeye.report');
    }

    public function setReportType($type)
    {
        $this->reportType = $type;
    }

    public function generate()
    {
        $validated = $this->validates();
        if (!$validated) {
            return;
        }
        $payload = encrypt(json_encode([
            'startDate'=> $this->startDate,
            'endDate' => $this->endDate,
            'reportType' => $this->reportType
        ]));
        return redirect()->route('download-report',['payload'=>$payload]);
    }

    public function validates()
    {
        $this->reset(['showIntervalError', 'showStartError', 'showEndError', 'showDateError']);
        if ($this->reportType == null) {
            $this->showIntervalError = true;
            return false;
        } elseif ($this->startDate == null) {
            $this->showStartError = true;
            return false;
        } elseif ($this->endDate == null) {
            $this->showEndError = true;
            return false;
        } else {
            $good = Carbon::parse($this->endDate)->gt(Carbon::parse($this->startDate));
            if (!$good) {
                $this->showDateError = true;
                return false;
            }
            return true;
        }
    }

    public function simbeyePdf()
    {
        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);

        if ($this->reportType == 'd') {
            $interval = 'Daily';
        } elseif ($this->reportType == 'w') {
            $interval = 'Weekly';
        } elseif ($this->reportType == 'm') {
            $interval = 'Monthly';
        }
        $reportType = $this->reportType;
        $rfidScans = SimbeyeScans::whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->orderBy('created_at')->get()->groupBy(
            function ($value) use ($reportType) {
                if ($this->reportType == 'd') {
                    return Carbon::parse($value->created_at)->format('D d/M/y');
                } elseif ($this->reportType == 'w') {
                    return Carbon::parse($value->created_at)->weekOfMonth . ' week-' . Carbon::parse($value->created_at)->format('M/y');
                } elseif ($this->reportType == 'm') {
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
        // dd($file);
        // header('Content-Type: application/pdf');
        // header('Content-Disposition: attachment; filename="file.pdf"');
        // echo $file;
        // return Response::download($file, 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="' . $pdfName . '"',
        // ]);
        // return response()->download('https://rescuetech.co.tz/RFID Report (30-Jan,23 To 01-Feb,23).pdf');
        return $file->download($pdfName);
    }

}
