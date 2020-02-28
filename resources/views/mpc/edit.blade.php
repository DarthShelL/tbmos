@extends('layouts.admin')

@section('content')
    <div class="container">
        <mpc-edit :id="{{$mpc->id}}"></mpc-edit>
    </div>
@endsection
