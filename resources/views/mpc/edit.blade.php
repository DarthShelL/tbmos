@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit component</h5>
            <mpc-edit :id="{{$mpc->id}}"></mpc-edit>
            </div>
        </div>
    </div>
@endsection
