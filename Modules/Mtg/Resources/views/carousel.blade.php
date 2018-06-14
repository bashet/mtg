<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @if($i = 1)
            @foreach($cards as $card)
                <div class="carousel-item {{$i++ == 1 ? 'active' : ''}}">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title text-white">{{$card->cardName}}</h3>
                            <img class="d-block w-100" src="{{url($card->front)}}" alt="{{$card->cardName}}">
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
            @endforeach
        @endif
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>