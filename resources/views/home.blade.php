@extends('layout')
@section('content')

    <div class="hero-wrapper bg-smoke hero-1" id="hero" style="background-image: url({!! asset('site/img/hero_bg_1_1.png') !!});">

        <div class="container mt-3">
            <div class="title-area text-start">
                <h2 class="sec-title style1">List transactions</h2>
            </div>
            <div class="row align-items-end">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>N Phone</th>
                        <th>Montant</th>
                        <th>Pays</th>
                        <th>Type transaction</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td></td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->amount}}</td>
                            <td>{{$item->country->name}}</td>
                            <td>{{$item->type_transaction}}</td>
                            <td>{{$item->status}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>





@endsection
