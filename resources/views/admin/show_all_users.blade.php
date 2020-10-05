@extends('home')

@section('frame1')
    <div class="row">
        <div class="col-12">
            <div class="card">
                    <table class="table table-striped">
                        @if(!$users == null)
                            <thead>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Cpf</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Permission</th>
                                <th>Actions</th>
                            </thead>
                            @foreach($users as $key => $user)
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
                                    <td>
                                        <p>
                                            <a href="{{ route('edit', $user->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete', $user->id) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </p>

                                    </td>
                                </tbody>
                            @endforeach
                        @else
                            <h5>Não foi possível encontrar usuários cadastrados!</h5>
                        @endif
                    </table>
            </div>
        </div>
    </div>
@stop
