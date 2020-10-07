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
    <table class="table table-responsive table-bordered">
        @if(!$logs == null)
            <thead class="thead-light">
                <th>#</th>
                <th>User ID</th>
                <th>Email</th>
                <th>Description</th>
                <th>Created</th>
            </thead>
            @foreach($logs as $key => $log)
                <tbody>
                    <td>{{$log->id}}</td>
                    <td>{{$log->user_id}}</td>
                    <td>{{$log->login}}</td>
                    <td>{{$log->description}}</td>
                    <td>{{$log->created_at}}</td>
                </tbody>
            @endforeach
        @else
            <h5>Não foi possível encontrar logs cadastrados!</h5>
        @endif
    </table>
@stop
