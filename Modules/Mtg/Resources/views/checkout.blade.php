@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{url(Module::asset('mtg:css/stripe.css'))}}">
@endpush

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://getaddress.io/js/jquery.getAddress-2.0.1.min.js"></script>
    <script src="{{url(Module::asset('mtg:js/checkout.js'))}}"></script>

    <script>
        const postcode_api = '{{env('postcode_api_key', '3Ihph0lYAU6P1llsphU68Q5211')}}';
        const strip_api = '{{env('STRIPE_KEY')}}';
    </script>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 pr-lg-1">
            <section class="card">
                <div class="card-header">
                    <h3 class="card-title">Cart Info</h3>
                </div>
                <div class="card-block">
                    @include('mtg::cart-details', ['cart' => $cart])
                </div>
            </section>
        </div>
        <div class="col-md-8 pl-lg-1">
            <section class="card">
                <div class="card-header">
                    <h3 class="card-title">Checkout</h3>
                </div>
                {!! Form::open(['id' => 'frm_checkout', 'url' => url('mtg/checkout')]) !!}
                <div class="card-block">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h3><i class="fas fa-user"></i> Personal Information</h3>
                            <div id="personal-info">

                                <div class="form-group row">
                                    {!! Form::label('name', 'Name*', ['class' => 'col-md-3 text-md-right']) !!}
                                    <div class="col-md-8">
                                        {!! Form::text('name', $user ? $user->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('phone_number', 'Phone Number*', ['class' => 'col-md-3 text-md-right']) !!}
                                    <div class="col-md-8">
                                        {!! Form::text('phone_number', $user ? $user->phone_number : '', ['class' => 'form-control', 'required' => 'required']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {!! Form::label('email', 'Email*', ['class' => 'col-md-3 text-md-right']) !!}
                                    <div class="col-md-8">
                                        {!! Form::email('email', $user ? $user->email : '', ['class' => 'form-control', 'required' => 'required']) !!}
                                    </div>
                                </div>
                                @if(auth()->guest())
                                    <div class="form-group text-center">
                                        <h5>Create an account (optional)<br>And save time on your next order!</h5>
                                    </div>
                                    <div class="form-group row">
                                        {!! Form::label('password', 'Password', ['class' => 'col-md-3 text-md-right']) !!}
                                        <div class="col-md-8">
                                            {!! Form::password('password', ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </li>
                        <li class="list-group-item">
                            <h3><i class="fas fa-address-card"></i> Address</h3>
                            @if(env('postcode_api_key'))
                                <div class="form-group row">
                                    <label class="col-md-3 text-md-right">Address Lookup</label>
                                    <div id="postcode_lookup" class="col-md-8"></div>
                                </div>
                            @endif
                            <div class="form-group row">
                                {!! Form::label('add_line_1', 'Address Line 1*', ['class' => 'col-md-3 text-md-right']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('add_line_1', '', ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('add_line_2', 'Address Line 2', ['class' => 'col-md-3 text-md-right']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('add_line_2', '', ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('add_line_3', 'Address Line 3', ['class' => 'col-md-3 text-md-right']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('add_line_3', '', ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('city', 'City*', ['class' => 'col-md-3 text-md-right']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('city', '', ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('county', 'County', ['class' => 'col-md-3 text-md-right']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('county', '', ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('postcode', 'Postcode*', ['class' => 'col-md-3 text-md-right']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('postcode', '', ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('note', 'Note', ['class' => 'col-md-3 text-md-right']) !!}
                                <div class="col-md-8">
                                    {!! Form::textarea('note', '', ['class' => 'form-control', 'rows' => 2]) !!}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <h3><i class="fas fa-credit-card"></i> Payment</h3>
                            <div class="form-group row">
                                {!! Form::label('', 'Enter Card details*', ['class' => 'col-md-3 text-md-right']) !!}
                                <div class="col-md-9">
                                    <div id="card-element"></div>
                                    <div id="card-errors" role="alert"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                {!! Form::hidden('amount', get_cart_amount(), ['id' => 'amount']) !!}
                {!! Form::close() !!}
                <div class="card-footer text-center">
                    <button id="btn_pay" class="btn btn-outline-primary btn-lg">Pay Now</button>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection