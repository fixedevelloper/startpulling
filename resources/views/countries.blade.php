@extends('layout')
@section('content')

    <div class="hero-wrapper bg-smoke hero-1" id="hero" style="background-image: url({!! asset('site/img/hero_bg_1_1.png') !!});">

        <div class="container mt-3">
            <div class="title-area text-start">
                <h2 class="sec-title style1">Listes des pays</h2>
            </div>
            <div class="row align-items-end">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>ISO</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->code_iso}}</td>
                            <td>{{$item->iso}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>





@endsection
