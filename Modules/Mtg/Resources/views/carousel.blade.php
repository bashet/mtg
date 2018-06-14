<div class="carousel-inner">
    @if($cards->count() && $i = 1)
        @foreach($cards as $card)
            <div data-id="{{$card->id}}" class="carousel-item {{$i == 1 ? 'active' : ''}}">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="card-title text-white">{{$card->cardName}}</h3>
                        <img class="d-block w-100" {{$i > 1 ? 'data-': ''}}src="{{url($card->front)}}" alt="{{$card->cardName}}">
                    </div>
                    <div class="col-sm-6 pt-5">
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