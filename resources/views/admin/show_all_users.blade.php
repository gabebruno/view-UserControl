@extends('home')

@section('frame1')
    <table class="table table-responsive table-bordered">
        @if(!$users == null)
            <thead class="thead-light">
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
                        <p class="btn-group">
                            <a href="{{ route('edit', $user->id) }}" class="btn btn-group btn-warning"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('delete', $user->id) }}" class="btn btn-group btn-danger"><i class="fas fa-trash"></i></a>
                        </p>
                    </td>
                </tbody>
            @endforeach
        @else
            <h5>Não foi possível encontrar usuários cadastrados!</h5>
        @endif
    </table>
@stop
