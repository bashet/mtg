@component('mail::message')

    {{-- Body --}}
    @component('mail::table')
        | Item       | Unit Price         | Quantity  |  Total
        | ------------- |:-------------:| --------:| ------:|
        @foreach($order->items as $item)
            | {{$item->card->cardName}}     | {{number_format($item->card->cardPrice, 2)}}      | {{$item->quantity}}      |    {{number_format($item->card->cardPrice * $item->quantity, 2)}} |
        @endforeach
    @endcomponent


    Thanks,
    {{ config('app.name') }}
@endcomponent

