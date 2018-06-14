@extends('user::layouts.master')


@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('user:js/add-user.js'))}}"></script>
@endpush

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{url('user')}}">All Users</a> </li>
    <li class="breadcrumb-item active">Edit User</li>
@endsection

@section('page-heading')
    Edit User
@endsection

@section('content')

    <section id="all_orders" class="card">
        <div class="card-header">
            <h4 class="card-title">Edit User</h4>
        </div>
        <div class="card-body">
            <div class="card-block">
                <form id="frm_add_new_user" class="form-horizontal" method="post" class="form form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 label-control text-right">Name*</label>
                        <div class="col-md-6">
                            <input type="text" name="name" id="name" class="form-control" required="required" value="{{$user->name}}">
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
                            <input type="email" name="email" id="email" class="form-control" required="required" value="{{$user->email}}">
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
                            <input type="password" id="password" name="password" class="form-control">
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
                            <select id="role_id" name="role_id[]" class="form-control select2" multiple="multiple">
                                <option value=""></option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{$user->roles->contains($role) ? 'selected' : ''}}>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 label-control text-right">Login Activated</label>
                        <div class="col-md-4 has-checkbox">
                            <input type="checkbox" name="active" class="switch" {{$user->active ? 'checked' :''}} id="active">
                        </div>
                    </div>

                    <input type="hidden" name="user_id" value="{{$user->id}}">

                    <div class="form-group row card-footer">
                        <label class="col-md-4"></label>
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-round btn-primary" value="Save Changes">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>

@endsection