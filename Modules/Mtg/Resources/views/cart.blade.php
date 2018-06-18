@extends('layouts.app')

@push('scripts')
    <script src="{{url(Module::asset('mtg:js/cart.js'))}}"></script>
@endpush

@section('content')
    <div class="container">
        <section class="card">
            <div class="card-header">
                <h3 class="card-title">Shopping Cart</h3>
            </div>
            <div id="cart_holder" class="card-block">
                @include('mtg::cart-details', ['cart' => $cart])
            </div>
            <div class="card-footer text-center">
                <a href="{{url('mtg/checkout')}}" class="btn btn-outline-info">Proceed to Checkout</a>
            </div>
        </section>
    </div>
@endsection
