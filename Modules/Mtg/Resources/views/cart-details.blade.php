<table class="table table-hover table-bordered mb-0" style="width: 100%">
    <thead>
    <tr>
        <th>Item</th>
        <th class="text-center">Price</th>
        <th class="text-center">Quantity</th>
        <th class="text-center">Total</th>
    </tr>
    </thead>
    <tbody>
    @if($cart->count())
        @php($total = 0)
        @foreach($cart  as $item => $quantity)
            @if($card = get_card_info_by_id($item))
                <tr>
                    <td>{{$card->cardName}}</td>
                    <td class="text-center">{{number_format($card->cardPrice, 2)}}</td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm" role="group">
                            <button data-id="{{$card->id}}" class="btn btn-danger minus"><i class="fas fa-minus-circle"></i></button>
                            <button class="btn btn-outline-info text-dark" disabled>{{$quantity}}</button>
                            <button data-id="{{$card->id}}" class="btn btn-primary plus"><i class="fas fa-plus-circle"></i></button>
                        </div>
                    </td>
                    {{--<td class="text-center"><input data-id="{{$card->id}}" type="number" value="{{$quantity}}" class="quantity form-control text-center"></td>--}}
                    <td class="text-center">{{number_format($card->cardPrice * $quantity, 2)}}</td>
                </tr>
                @php($total = $total + ($card->cardPrice * $quantity))
            @endif
        @endforeach
        <tr>
            <th colspan="3" class="text-right">Grand Total</th>
            <th class="text-center">{{number_format($total, 2)}}</th>
        </tr>
    @else
        <tr>
            <td colspan="4">
                <div class="alert alert-info">
                    Shopping cart is empty
                </div>
            </td>
        </tr>
    @endif
    </tbody>
</table>