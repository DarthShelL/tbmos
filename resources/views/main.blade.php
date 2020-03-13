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
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="#">Navbar</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                        </div>
                    </nav>
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
    </div>
@endsection
