@extends('simbeye.layout-admin')
@section('content')
    <h1>Dashboard</h1>
    <div class="row pt-2 mx-5">
        <div class="col-xl-3 col-md-6 pt-3">
            <?php $data = [
                'title' => 'Registered Users',
                'content' => 234,
                'sub_title' => 'All Registers Users',
            ]; ?>
            {{-- <a href="#"> --}}
            @include('simbeye.includes.cards.users-card', $data)</a>
        </div>
        <div class="col-xl-3 col-md-6 pt-3">
            <?php $data = [
                'title' => 'Usage Today',
                'content' => 234,
                'sub_title' => 'All scans that have happened today',
            ]; ?>
            @include('simbeye.includes.cards.subscriptions-card', $data)
        </div>
        <div class="col-xl-3 col-md-6 pt-3">
            <?php $data = [
                'title' => 'Today Payments',
                'content' => '3534' . ' Tsh',
                'sub_title' => 'All payments collected today',
            ]; ?>
            @include('simbeye.includes.cards.payment-card', $data)
        </div>
        <div class="col-xl-3 col-md-6 pt-3">
            <?php $data = [
                'title' => 'Total Payments',
                'content' => '3534' . ' Tsh',
                'sub_title' => 'All Payments ever made',
            ]; ?>
            @include('simbeye.includes.cards.payment-card', $data)
        </div>

    </div>

    <div class="div mx-5 pt-3">
        <div class="card">
            <div class="card-body">
                <div class="col-xl-6 pt-3">
                    <div class="card mb-6 graphCard border-0">
                        <div class="card-header">
                            Searches
                        </div>
                        <div class="card-body border-bottom">
                            {{-- {!! $chart->container() !!}
                        {!! $chart->script() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="col-xl-6 pt-3">
                    <div class="card mb-6 graphCard border-0">
                        <div class="card-header">
                            Searches
                        </div>
                        <div class="card-body border-bottom">
                            {{-- {!! $chart->container() !!}
                        {!! $chart->script() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
