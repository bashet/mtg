@component('mail::message')
    Dear {{$order->name}},<br><br>
    Thank you for your order. Please find below what have ordered.<br>
    <br>
    @component('mail::table')
    | Item | Unit Price | Quantity | Total |
    | ---- | : -------: | --------: | ----: |
    @foreach($order->items as $item)
        |{{$item->card->cardName}}|{{number_format($item->card->cardPrice, 2)}}|{{$item->quantity}}|{{number_format($item->card->cardPrice * $item->quantity, 2)}}|
    @endforeach
    @endcomponent<br>
    <br>Thanks,<br>
    {{ config('app.name') }}
@endcomponent

