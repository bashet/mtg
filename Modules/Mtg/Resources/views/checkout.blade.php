@extends('layouts.app')


@section('content')
<div class="container">
    <section class="card">
        <div class="card-header">
            <h3 class="card-title">Checkout</h3>
        </div>
        {!! Form::open(['id' => 'frm_create_user_account', 'url' => 'mtg/checkout']) !!}
        <div class="card-block">
            <ul class="list-group">
                <li class="list-group-item">
                    <h3><i class="fas fa-user"></i> Personal Information</h3>
                    <div id="personal-info">

                        <div class="form-group row">
                            {!! Form::label('name', 'Name', ['class' => 'col-md-3 text-right']) !!}
                            <div class="col-md-8">
                                {!! Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('phone_number', 'Phone Number', ['class' => 'col-md-3 text-right']) !!}
                            <div class="col-md-8">
                                {!! Form::text('phone_number', '', ['class' => 'form-control', 'required' => 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('email', 'Email', ['class' => 'col-md-3 text-right']) !!}
                            <div class="col-md-8">
                                {!! Form::email('email', '', ['class' => 'form-control', 'required' => 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <h5>Create an account (optional)<br>And save time on your next order!</h5>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('password', 'Password', ['class' => 'col-md-3 text-right']) !!}
                            <div class="col-md-8">
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>
                        </div>

                    </div>
                </li>
                <li class="list-group-item">
                    <h3><i class="fas fa-address-card"></i> Address</h3>
                    <div class="form-group row">
                        {!! Form::label('add_line_1', 'Address Line 1', ['class' => 'col-md-3 text-right']) !!}
                        <div class="col-md-8">
                            {!! Form::text('add_line_1', '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('add_line_2', 'Address Line 2', ['class' => 'col-md-3 text-right']) !!}
                        <div class="col-md-8">
                            {!! Form::text('add_line_2', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('add_line_3', 'Address Line 3', ['class' => 'col-md-3 text-right']) !!}
                        <div class="col-md-8">
                            {!! Form::text('add_line_3', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('city', 'City', ['class' => 'col-md-3 text-right']) !!}
                        <div class="col-md-8">
                            {!! Form::text('city', '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('county', 'County', ['class' => 'col-md-3 text-right']) !!}
                        <div class="col-md-8">
                            {!! Form::text('county', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('postcode', 'Postcode', ['class' => 'col-md-3 text-right']) !!}
                        <div class="col-md-8">
                            {!! Form::text('postcode', '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <h3><i class="fas fa-credit-card"></i> Payment</h3>
                </li>
            </ul>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-outline-primary btn-lg">Submit</button>
        </div>
        {!! Form::close() !!}
    </section>
</div>
@endsection