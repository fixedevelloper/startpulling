@extends('layout')
@section('content')

    <div class="hero-wrapper bg-smoke hero-1" id="hero" style="background-image: url({!! asset('site/img/hero_bg_1_1.png') !!});">

        <div class="container mt-3">
            <div class="title-area text-start">
                <h2 class="sec-title style1">Balance</h2>
            </div>
            <div class="row align-items-end">
                <table class="table">
                    <thead>
                    <tr>
                        <th>amount</th>
                        <th>inUsing</th>
                        <th>available</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{$items['data']['amount']}}</td>
                            <td>{{$items['data']['inUsing']}}</td>
                            <td>{{$items['data']['available']}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>





@endsection
