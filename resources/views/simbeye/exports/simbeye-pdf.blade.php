<html>

<head>
    <title></title>
    <style>
        body {

            margin: 15px;
            /* opacity: 0.1; */
        }

        thead {
            text-align: center
        }

        .tableHead {
            background-color: rgb(182, 208, 190);
            color: rgb(0, 0, 0);
        }

        tbody tr:nth-child(odd) {
            background-color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #ddd;
        }

        .total {
            background-color: rgb(201, 201, 201);
            color: rgb(0, 0, 0);
            font-weight: bold;
        }

        .zrb {
            color: rgb(38, 38, 38);
            font-weight: bold;
            font-size: 30px;
        }

        .dates {
            font-weight: bold;
            font-size: 25px;
        }

        .table {
            border: 1px solid black;
            width: 100%;
            border-collapse: collapse;
        }

        .all-text {
            color: rgb(46, 46, 46);
        }

        .main-text {
            font-size: 20px;
        }

        .summary-table {
            border: 1px solid black;
            width: 60%;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body style="font-size: 6pt">
    <table style="border-collapse:collapse; width:100%">
        <thead>
            <tr>
                <th style="text-align:center;" colspan="10">
                    <strong class="zrb all-text">SMARTCARD READER REPORT</strong><br>
                    <strong class="dates all-text"><small> From {{ $dates['startDateName'] }} To {{ $dates['endDateName'] }}</small>
                    </strong> <br>
                    <strong class="dates all-text">({{ $interval }} Interval )</strong>
                </th>
            </tr>
        </thead>
    </table>
    <br>
    <table class="summary-table">
        <thead>
            <tr>
                <th class="tableHead" colspan="10">
                    <strong style="font-size: 25px;" class="all-text">Report Summary</strong>
                </th>
            </tr>
        </thead>
    </table>
    <table class="summary-table">
        <tbody>
            @foreach ($summaries as $title => $summary)
                <tr>
                    <td></td>
                    <td style=" font-size: 20px;" class="all-text"> <strong>{{ $title }}</strong></td>
                    <td></td>
                    <td style="font-size: 20px;" class="all-text">{{ $summary }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
    <img src="{{ $chartUrl }}" alt="">
    <br><br><br><br><br>
    <table class="table">
        <thead class="tableHead">
            <tr>
                <th colspan="10">
                    <strong class="all-text" style="font-size: 23px;">DETAILED REPORT</strong>
                </th>
            </tr>
        </thead>
    </table>
    <table class="table">
        <thead class="tableHead">
            <tr>
                <th style="text-align:center; border: 1px solid black;">
                    <strong class="all-text main-text">Period</strong>
                </th>
                <th style="text-align:center; border: 1px solid black;">
                    <strong class="all-text main-text">Collections (Tsh)</strong>
                </th>
                <th style="text-align:center;border: 1px solid black;">
                    <strong class="all-text main-text">Average Collections (Tsh)</strong>
                </th>
                <th style="text-align:center; border: 1px solid black;">
                    <strong class="all-text main-text">RFID usage</strong>
                </th>
                <th style="text-align:center; border: 1px solid black;">
                    <strong class="all-text main-text">RFID usage variance</strong>
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $copy = $rfidScans;
                $lengths = array_map('count', $copy->toArray());
                $averageScans = array_sum($lengths) / count($lengths);
            @endphp
            @foreach ($rfidScans as $index => $scan)
                <tr>
                    <td class="main-text all-text" style="text-align:center; border: 1px solid black;" >
                        {{ $index }}</td>
                    <td class="main-text all-text" style="text-align:center; border: 1px solid black;" >
                        {{ number_format($scan->sum('amount')) }}
                    </td>
                    <td class="main-text all-text" style="text-align:center; border: 1px solid black;" >
                        {{ number_format($scan->average('amount')) }}</td>
                    <td class="main-text all-text" style="text-align:center; border: 1px solid black;" >
                        {{ number_format($scan->count()) }}</td>
                    <td class="main-text all-text" style="text-align:center; border: 1px solid black;" >
                        {{ number_format(count($rfidScans[$index])-$averageScans) }}</td>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>

</body>

</html>
