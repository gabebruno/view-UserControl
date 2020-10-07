@extends('home')

@section('frame1')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Editar usuario {{$user->name}}</h3>
        </div>
        <form class="form-horizontal" action="{{ route('update_me') }}" method="post" >
            @method('put')
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id" value="{{$user->id}}">
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="tel" class="form-control" name="phone" id="phone" value="{{$user->phone}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="address" id="address" value="{{$user->address}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="cpf" class="col-sm-2 control-label">CPF</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="cpf" id="cpf" value="{{$user->cpf}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary ">Submit</button>
            </div>
        </form>
    </div>
@stop
