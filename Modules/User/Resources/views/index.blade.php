@extends('user::layouts.master')

@push('style')
    <link href="{{ asset('plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{url('plugins/DataTables/datatables.min.js')}}"></script>
    <script type="application/javascript" src="{{url(Module::asset('user:js/index.js'))}}"></script>
@endpush
@section('breadcrumb-item')
    <li class="breadcrumb-item active">All Users</li>
@endsection

@section('page-top-right-corner')
    @can('add_new_user', auth()->user())
        <a href="{{url('user/add-new')}}" class="btn btn-outline-primary"><i class="icon-user-plus"></i> Add New User</a>
    @endcan
@endsection
@section('page-heading')
    <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-users"></i> All Users </h1>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Showing All Users</h4>
            </div>
            <div class="card-body">
                <div class="card-block">
                    <table id="users" class="table table-bordered table-hover table-condensed compact" width="100%">
                        <thead>
                        <tr>
                            <th class="text-center">SN</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Enabled</th>
                            <th class="text-center">Actions</th>
                            <th class="text-center">Last Access</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($users->count() && $i=1)
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{$i++}}</td>
                                    <td><a href="{{url('user/view/'.$user->id)}}">{{$user->name}}</a></td>
                                    <td><a href="{{url('user/view/'.$user->id)}}">{{$user->email}}</a></td>
                                    <td class="text-center">{{title_case($user->roleAll()->implode(', '))}}</td>
                                    <td class="text-center has-checkbox">
                                        @if($user->id != Auth::id())
                                            @can('change_user_status', $user)
                                                <input type="checkbox" data-id="{{$user->id}}" data-group-cls="btn-group-sm" class="switch" {{($user->active ? 'checked' : '')}}>
                                            @else
                                                @if($user->active)
                                                    <span class="green">Yes</span>
                                                @else
                                                    <span class="red">No</span>
                                                @endif
                                            @endcan
                                        @else
                                            @if($user->active)
                                                <span class="green">Yes</span>
                                            @else
                                                <span class="red">No</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            @can('login_as', $user)
                                                <a href="{{url('login_as/'.$user->id)}}" class="btn btn-info" title="Login as this user"><i class="icon-user-secret"></i></a>
                                            @endcan
                                            @can('edit_user', $user)
                                                <a href="{{url('user/edit/'.$user->id)}}" class="btn btn-warning" title="Edit User"><i class="icon-pencil"></i></a>
                                            @endcan
                                            @can('delete_user', $user)
                                                <a href="{{url('user/delete/'. $user->id)}}"  title="Delete User" class="btn btn-danger delete_user"><i class="icon-trash"></i> </a>
                                            @endcan
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $user->last_login ? $user->last_login->format('d/m/Y H:i:s') : ''}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection