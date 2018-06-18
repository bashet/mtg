@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="card">
            <div class="card-header">
                <h3 class="card-title">Shopping Cart</h3>
            </div>
            <div class="card-block">
                <table class="table table-hover table-bordered mb-0">
                    <thead>
                    <tr>
                        <th class="text-center">SN</th>
                        <th>Item</th>
                        <th class="text-center">Unit Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($cart->count() && $i = 1)
                        @php($total = 0)
                        @foreach($cart  as $item => $quantity)
                            @if($card = get_card_info_by_id($item))
                                <tr>
                                    <td class="text-center">{{$i++}}</td>
                                    <td>{{$card->cardName}}</td>
                                    <td class="text-center">{{number_format($card->cardPrice, 2)}}</td>
                                    <td class="text-center">{{$quantity}}</td>
                                    <td class="text-center">{{number_format($card->cardPrice * $quantity, 2)}}</td>
                                </tr>
                                @php($total = $total + ($card->cardPrice * $quantity))
                            @endif
                        @endforeach
                        <tr>
                            <th colspan="4" class="text-right">Grand Total</th>
                            <th class="text-center">{{number_format($total, 2)}}</th>
                        </tr>
                    @else
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-info">
                                    Shopping cart is empty
                                </div>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="{{url('mtg/checkout')}}" class="btn btn-outline-info">Proceed to Checkout</a>
            </div>
        </section>
    </div>
@endsection
