@extends('layout')
@section('content')

    <div class="hero-wrapper bg-smoke hero-1" id="hero" style="background-image: url({!! asset('site/img/hero_bg_1_1.png') !!});">

        <div class="container mt-3">
            <div class="title-area text-start">

                <h2 class="sec-title style1">Ajouter  transaction</h2>
            </div>
            <form method="POST">
                <div class="row align-items-end">
                    <div class="contact-form">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <input name="name" type="text" placeholder="Customer Name" class="form-control style-border">
                            </div>
                            <div class="col-md-12 form-group">
                                <select name="country" id="country" class="form-select style-border">
                                    <option value="" disabled="" selected="" hidden="">Pays</option>
                                    @foreach($items as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach

                                </select>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="col-md-12 form-group">
                                <select name="bank_id" id="sim" class="form-select style-border">
                                    <option value="" disabled="" selected="" hidden="">Gateway</option>
                                </select>
                                <i class="fas fa-angle-down"></i>
                            </div>
                            <div class="col-md-12 form-group">
                                <input name="phone" type="text" placeholder="Phone Number" class="form-control style-border">
                            </div>

                            <div class="col-md-12 form-group">
                                <input name="amount" autocomplete="off" type="text" placeholder="Montant" class="form-control style-border">
                            </div>
                            <div class="col-12 form-group mb-0">
                                <button class="global-btn w-100">Envoyer<img src="assets/img/icon/right-icon.svg" alt=""></button>
                            </div>
                        </div>
                    </div>
                </div>
                @csrf
            </form>

        </div>
    </div>

@endsection
@push('js')
    <script>
        $("#country").change(function () {
            $.ajax({
                url: configs.routes.getsims,
                type: "GET",
                dataType: "JSON",
                data: {
                    'country_id': $(this).val(),
                },
                success: function (data) {
                    $('#sim').html('')
                    $.each(data.data, function (index, item) {
                        $('#sim').append('<option value="'+item["id"]+'">'+item["name"]+'</option>')
                    })

                },
                error: function (err) {
                    alert("An error ocurred while loading data ...");
                }
            })
        })
    </script>
@endpush
