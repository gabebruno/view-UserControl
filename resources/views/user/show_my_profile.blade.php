@extends('home')

@section('frame1')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row col-12">
        <div>
            <div class="card">
                <table class="table table-responsive">
                    <thead class="thead-light">
                        <th>Email</th>
                        <th>Name</th>
                        <th>Cpf</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Permission</th>
                    </thead>
                    <tbody>
                        <td>{{$user->email}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->cpf}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->phone}}</td>
                        <td>
                            @if($user->permission == 1)
                                Client
                            @else
                                Admin
                            @endif
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
