<div class="carousel-inner">
    @if($cards->count() && $i = 1)
        @foreach($cards as $card)
            <div data-id="{{$card->id}}" class="carousel-item {{$i == 1 ? 'active' : ''}}">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title text-white">{{$card->cardName}}</h3>
                        <img class="d-block w-100" {{$i > 1 ? 'data-': ''}}src="{{url($card->front)}}" alt="{{$card->cardName}}">
                    </div>
                    <div class="col-sm-6">
                        <div class="clearfix text-white">
                            @if($card->qty)
                                Cards Available: {{$card->qty}}
                                <button data-id="{{$card->id}}" class="btn btn-outline-warning fa-pull-right add_to_cart"><i class="fas fa-cart-plus"></i></button>
                            @else
                                Out of stock
                                <button class="btn btn-outline-warning fa-pull-right" disabled="disabled"><i class="fas fa-cart-plus"></i></button>
                            @endif
                        </div>
                        <p class="card-text text-white">{{$card->cardType}}</p>
                        <p class="card-text text-white">{!! symbol($card->cardManaCost) !!}</p>
                        <p class="card-text text-white">{{$card->artist}}</p>
                        <p class="card-text text-white">{!! symbol($card->cardText) !!}</p>
                        <p class="card-text text-white">{{$card->cardFlavour}}</p>
                    </div>
                </div>
            </div>
            @php($i++)
        @endforeach
    @endif
</div>