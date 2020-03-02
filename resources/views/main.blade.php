@extends('layouts.app')

@push('header_scripts')
    <script src="{{ asset('js/screen.js') }}"></script>
@endpush

@push('styles')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endpush

@section('content')
    <section class="screen header-screen">
        <div class="container" id="app">
            header screen
        </div>
    </section>
    <section class="screen">
        <div class="container"></div>
    </section>
    <section class="screen">
        <div class="container"></div>
    </section>
    <section class="screen">
        <div class="container"></div>
    </section>
    <section class="screen">
        <div class="container"></div>
    </section>
@endsection
