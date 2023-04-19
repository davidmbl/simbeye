@extends('simbeye.layout-admin')
@section('content')
<h1>RFID Management</h1>

    {{-- <div class="row pt-5 px-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="text-center ">
                <h3>RFID Management</h3>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div> --}}

    <div class="row pt-3 px-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="float-right mb-4 ">
                @livewire('simbeye.rfid-price')
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>


    <div class="row pt-3 px-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="float-right mb-4 ">
                <a href="{{ route('rfid-add') }}" class="btn btn-success btn-sm px-4">ADD</a>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="row pt-0 px-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            @livewire('simbeye.rfid-table')
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection
