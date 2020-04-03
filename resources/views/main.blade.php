@extends('layouts.app')

@push('header_scripts')
    <script src="{{ asset('js/screen.js') }}"></script>
@endpush

@push('styles')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="screen-wrapper">
        <section class="screen header-screen">
            <div class="">
                <div class="header-bg">
                    <nav class="navbar navbar-expand-lg navbar-dark">
                        <a class="navbar-brand" href="/"><img src="/tbmos-logo-white.svg" alt=""></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse flex-grow-1 text-right" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto flex-nowrap">
                                @php
                                    $i=1
                                @endphp
                                @foreach ($mpcs as $mpc)
                                @php
                                    $i++
                                @endphp
                                <li class="nav-item active">
                                    <a class="nav-link" href="#" onclick="DSSC.goto({{$i}})">{{$mpc->title}}</span></a>
                                </li>
                                @endforeach
                                <li class="nav-item active">
                                    <a class="nav-link" href="#" onclick="DSSC.goto({{++$i}})">kontaktní údaje</span></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="header-title">Software je investice</div>
                    <div class="header-description">Může váš business zmnohonásobit a rychle si na sebe vydělat. TBM OS zabývající se softwarovým a technologickým vývojem a spolupracující s odborníky z celého světa, Vám ukáže jak.</div>
                    <div class="header-caption">Co nabízíme?</div>
                </div>
            </div>
            <div class="slider-section">
                <div class="">
                    <mpc-slider></mpc-slider>
                </div>
            </div>
        </section>
        @foreach ($mpcs as $mpc)
        <section class="screen">
            <div class="">
                <div class="totop-btn"></div>
                <div class="sc-screen-title">{{$mpc->title}}</div>
                <div class="sc-screen-container" style="
                    background-image:url('{{Storage::url($mpc->screen_image)}}');
                    color: {{$mpc->font_color}}
                ">
                    <p>
                        {{$mpc->description}}
                    </p>
                </div>
            </div>
        </section>
        @endforeach
        <section class="screen footer">
            <div class="totop-btn"></div>
            <div class="flexbox">
                <div class="container">
                    <div class="row owners">
                        <div class="col-6">
                            <span class="name">
                                Miroslav Usnul
                            </span>
                            <br>
                            <span class="phone">
                                +420774440905
                            </span>
                        </div>
                        <div class="col-6">
                            <span class="name">
                                Martin Zábojník
                            </span>
                            <br>
                            <span class="phone">
                                +420735286795
                            </span>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="row contacts">
                        <div class="col-12">
                            DEREO, spol. s r. o.
                        </div>
                        <div class="col-12">
                            IČO: 25630563
                        </div>
                        <div class="col-12">
                            Plzeňská 2561/164, Smíchov, 150 00 Praha 5
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="row created">
                        <div class="container text-center">
                            <a href="mailto:shellnosferatu@gmail.com">created by Vladimir Shelestov aka DarthShelL</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
