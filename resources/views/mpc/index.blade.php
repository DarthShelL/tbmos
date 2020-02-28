@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Main page component index</h5>

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">title</th>
                        <th scope="col">description</th>
                        <th scope="col">controls</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($mpcs as $mpc)
                        <tr>
                            <td>{{$mpc->title}}</td>
                            <td>{{$mpc->description}}</td>
                            <td><a class="btn btn-primary" title="edit component" href="{{ route('MainPageComponent.edit', $mpc->id) }}"><i class="far fa-edit"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection
