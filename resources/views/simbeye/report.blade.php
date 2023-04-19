@extends('simbeye.layout-admin')
@section('content')
<div class="row">
    <div class="col-12 text-center">
        <h1>Sytem Reports</h1>
    </div>
</div>
    <div class="row pt-5 px-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            @livewire('simbeye.report')
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection
