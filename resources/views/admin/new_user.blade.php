@extends('home')

@section('frame1')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Novo usuario</h3>
        </div>
        <form class="form-horizontal" action="{{ route('new_user') }}" method="post" >
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id">
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-8">
                        <input type="tel" class="form-control" name="phone" id="phone">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                </div>

                <div class="form-group">
                    <label for="cpf" class="col-sm-2 control-label">CPF</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="cpf" id="cpf">
                    </div>
                </div>

                <div class="form-group">
                    <label for="permission" class="col-sm-2 control-label">Permission</label>
                    <div class="col-sm-8">
                        <select name="permission" id="permission" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option value="2">Admin</option>
                                <option selected value="1">Client</option>
                        </select>
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
