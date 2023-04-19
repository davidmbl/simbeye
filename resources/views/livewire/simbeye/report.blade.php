<div>
     <style>
        .downloadd-button {
            position: relative;
            border-width: 0;
            color: white;
            font-size: 15px;
            font-weight: 600;
            border-radius: 4px;
            z-index: 1;
        }

        .downloadd-button .docs {
            display: flex;
            align-items: center;
            justify-content: center;
            /* gap: 10px; */
            min-height: 40px;
            /* padding: 0 10px; */
            margin-top: auto;
            margin-bottom: auto;
            border-radius: 4px;
            z-index: 1;
            background-color:#2b8043;
            border: solid 1px #e8e8e82d;
            transition: all .5s cubic-bezier(0.77, 0, 0.175, 1);
            color: whitesmoke;
        }

        .downloadd-button:hover {
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            cursor: pointer;
        }

        .downloadd {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 90%;
            margin: 0 auto;
            z-index: -1;
            border-radius: 4px;
            transform: translateY(0%);
            background-color: #12e16291;
            border: solid 1px #01e0572d;
            transition: all .5s cubic-bezier(0.77, 0, 0.175, 1);
        }

        .downloadd-button:hover .downloadd {
            transform: translateY(100%)
        }

        .downloadd svg polyline,
        .downloadd svg line {
            animation: docs 1s infinite;
        }

        @keyframes docs {
            0% {
                transform: translateY(0%);
            }

            50% {
                transform: translateY(-15%);
            }

            100% {
                transform: translateY(0%);
            }
        }
    </style>

    <div class="row">
        <div class="col-12">
            <h6><b>Report Type : </b></h6>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <button type="button"
                class="btn @if ($reportType == 'd') btn-secondary @else btn-outline-secondary @endif "
                wire:click="setReportType('d')"> <small> Daily Interval</small></button>
        </div>
        <div class="col-4">
            <button type="button"
                class="btn @if ($reportType == 'w') btn-secondary @else btn-outline-secondary @endif "
                wire:click="setReportType('w')"><small>Weekly Interval</small></button>
        </div>
        <div class="col-4">
            <button type="button"
                class="btn @if ($reportType == 'm') btn-secondary @else btn-outline-secondary @endif "
                wire:click="setReportType('m')"><small>Monthly Interval</small></button>
        </div>
    </div>
    <div class="row">
        @if ($showIntervalError)
            <div class="col-12">
                <span style="color:red"> <small> Please select report interval</small></span>
            </div>
        @endif
    </div>
    <div class="row pt-4">
        <div class="col-12">
            <h6><b>Report Period :</b></h6>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label for="start">Start Date</label>
            <input type="date" id="start" wire:model="startDate" class="form-control" max="{{ date('Y-m-d') }}">
        </div>
        <div class="col-6">
            <label for="end">End Date</label>
            <input type="date" id="end" wire:model="endDate" class="form-control" max="{{ date('Y-m-d') }}">
        </div>
    </div>
    <div class="row">

        <div class="col-6">
            @if ($showStartError)
                <span style="color:red"> <small> Please select start date</small></span>
            @endif
        </div>
        <div class="col-6">
            @if ($showEndError)
                <span style="color:red"><small>Please select end date</small></span>
            @endif
        </div>
        @if ($showDateError)
            <div class="col-12">
                <span style="color:red"> <small> End date must be greater than start date</small></span>
            </div>
        @endif
    </div>
    <div class="row pt-4">
        <div class="col-3"></div>
        <div class="col-6 pt-4">
                {{-- <button type="button" class="btn btn-outline-success text-uppercase" wire:click.prevent='generate'>
                    Generate
                </button> --}}

                <a wire:click.prevent='generate' class="downloadd-button">
                    <div class="docs text-center"><i class="fa fa-file-pdf-o" style="font-size:23px;color:white"></i> &nbsp;&nbsp; GENERATE REPORT</div>
                    <div class="downloadd">
                      <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line y2="3" x2="12" y1="15" x1="12"></line></svg>
                    </div>
                </a>
        </div>
        <div class="col-3"></div>
    </div>



    {{-- <button class="download-button">
        <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line y2="13" x2="8" y1="13" x1="16"></line><line y2="17" x2="8" y1="17" x1="16"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Docs</div>
        <div class="download">
          <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line y2="3" x2="12" y1="15" x1="12"></line></svg>
        </div>
      </button> --}}
</div>
