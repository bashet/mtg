@component('mail::message')
    Dear {{$order->name}},<br><br>
    Thank you for your order. Your order reference number is: #{{$order->id}}<br><br>
    Please find below what have ordered.<br>
    <br>
    @component('mail::table')
        | Item | Unit Price | Quantity | Total |
        | :---- | : -------: | :------: | ----: |
        @foreach($order->items as $item)
            |{{$item->card->cardName}}|{{number_format($item->card->cardPrice, 2)}}|{{$item->quantity}}|{{number_format($item->card->cardPrice * $item->quantity, 2)}}|
        @endforeach
        | | | Shipping Charge | {{number_format($order->shipping_cost, 2)}} |
        | | | Payment Handling Charge | {{number_format($order->handling_cost, 2)}} |
        | | | Grand Total | {{number_format($total, 2)}} |
    @endcomponent<br>
    Your order will be delivered to the following address<br>
    {{$order->add_line_1}}
    @if($order->add_line_2)
        <br> {{$order->add_line_2}}
    @endif
    @if($order->add_line_3)
        <br> {{$order->add_line_3}}
    @endif
    <br>{{$order->city}}
    @if($order->county)
        <br> {{$order->county}}
    @endif
    <br>{{$order->postcode}}<br>
    <br>Thanks,<br>
    {{ config('app.name') }}
@endcomponent

