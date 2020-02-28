@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add main page component</h5>
                <div class="col-8 offset-2">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('MainPageComponent.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-label">title:</div>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="row">
                            <div class="form-label">description:</div>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="form-label">screen image:</div>
                            <input type="file" class="form-control" name="screen_image">
                        </div>
                        <br>
                        <div class="row">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
