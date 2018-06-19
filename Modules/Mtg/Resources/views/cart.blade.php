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
            <div id="cart_footer" class="card-footer text-center">
                @if(get_cart_amount() >= env('minimum', 0) )
                    <a href="{{url('mtg/checkout')}}" class="btn btn-outline-info">Proceed to Checkout</a>
                @else
                    <div class="alert alert-danger">
                        Minimum order amount must be grater or equal to £{{number_format(env('minimum', 0), 2)}}
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
