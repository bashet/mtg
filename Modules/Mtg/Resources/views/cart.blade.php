@extends('layouts.app')

@push('scripts')
    <script>
        $("input[type='number']").InputSpinner({
            // button text/icons
            decrementButton: '<i class="fas fa-minus-circle text-danger"></i>',
            incrementButton: '<i class="fas fa-plus-circle text-primary"></i>',

            // class of input group
            groupClass: "input-group-spinner",

            // button class
            buttonsClass: "btn-warning",

            // button width
            buttonsWidth: "2.5em",

            // text alignment
            textAlign: "center",

            // delay in milliseconds
            autoDelay: 500,

            // interval in milliseconds
            autoInterval: 100,

            // boost after these steps
            boostThreshold: 15,

            // boost multiplier
            boostMultiplier: 2,

            // detects the local from `navigator.language`, if null
            locale: null
        });
    </script>
@endpush

@section('content')
    <div class="container">
        <section class="card">
            <div class="card-header">
                <h3 class="card-title">Shopping Cart</h3>
            </div>
            <div class="card-block">
                @include('mtg::cart-details', ['cart' => $cart])
            </div>
            <div class="card-footer text-center">
                <a href="{{url('mtg/checkout')}}" class="btn btn-outline-info">Proceed to Checkout</a>
            </div>
        </section>
    </div>
@endsection
