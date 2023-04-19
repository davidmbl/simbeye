@extends('simbeye.layout-admin')
@section('content')
    <div class="row pt-5 px-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            @livewire('simbeye.rfid-add')
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection
