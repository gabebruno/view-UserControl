@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="m-0 text-dark" align="center">Cadastro de usuarios.</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card">
                <div class="card-body">
                    @yield('frame1')
                </div>
            </div>
        </div>
    @include('scripts')
@stop
