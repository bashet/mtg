@extends('user::layouts.master')

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('user:js/add-user.js'))}}"></script>
@endpush

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{url('user')}}">All Users</a> </li>
    <li class="breadcrumb-item active">Add New User</li>
@endsection

@section('page-heading')
    Add New User
@endsection

@section('content')

    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Enter User Information</h4>
        </div>
        <div class="card-body ">
            <div class="card-block">
                <form id="frm_add_new_user" action="{{url('user/add-new')}}" method="post" class="form form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 label-control text-right">Name*</label>
                        <div class="col-md-6">
                            <input type="text" name="name" id="name" class="form-control" required="required" value="">
                            @if ($errors->has('email'))
                                <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 label-control text-right">E-Mail Address*</label>
                        <div class="col-md-6">
                            <input type="email" name="email" id="email" class="form-control" required="required" value="">
                            @if ($errors->has('email'))
                                <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 label-control text-right">Password*</label>
                        <div class="col-md-4">
                            <input type="password" id="password" name="password" class="form-control" required="required">
                            @if ($errors->has('email'))
                                <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role_id" class="col-md-4 label-control text-right">Role</label>
                        <div class="col-md-4">
                            <select id="role_id" name="role_id[]" class="form-control" multiple="multiple">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{title_case($role->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 label-control text-right">Login Activated</label>
                        <div class="col-md-4 has-checkbox">
                            <input type="checkbox" name="active" class="switch" id="active">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 label-control text-right">Send Email to User</label>
                        <div class="col-md-6 has-checkbox">
                            <input type="checkbox" name="send_email" class="switch" id="send_email">
                        </div>
                    </div>
                    <div class="form-group row card-footer">
                        <label class="col-md-4"></label>
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-round btn-primary" value="Create New User">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection