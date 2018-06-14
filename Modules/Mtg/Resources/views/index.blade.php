@extends('layouts.app')

@push('scripts')
    <script src="{{url(Module::asset('mtg:js/carousel.js'))}}"></script>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {!! Form::open(['class' => 'form-inline']) !!}
                        {!! Form::label('carouselchoose', 'Set', ['class' => 'col-sm-2']) !!}
                        <div class="col-sm-6">{!! get_card_select($sets) !!}</div>
                        <div class="col-sm-4">
                            <div class="btn-group fa-pull-right" role="group">
                                <a id="seticon" href="#" class="btn btn-link"><i class="ss ss-{{strtolower($first_set->code)}} ss-grad ss-3x"></i></a>
                                {{--<a id="acards" href="#" class="btn btn-link"><em class="h4 text-lt">{{$first_set->cards->sum('qty')}}</em></a>--}}
                                {{--<a id="tcards" href="#" class="btn btn-link"><em class="h4 text-lt">{{$first_set->cards->count()}}</em></a>--}}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div class="card-body bg-dark">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                            @include('mtg::carousel', ['cards' => $cards])

                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                    <div class="card-footer text-center">
                        <div class="btn-group" role="group">
                            <button id="carousel_prev" class="btn btn-outline-info"><i class="fas fa-arrow-circle-left"></i></button>
                            <button id="btn_info" class="btn btn-outline-info">1 of {{$first_set->cards->count()}}</button>
                            <button id="carousel_next" class="btn btn-outline-info"><i class="fas fa-arrow-circle-right"></i></button>
                        </div>
                    </div>
                    <input type="hidden" id="total_cards" value="{{$first_set->cards->count()}}">
                </div>
            </div>
        </div>
    </div>
@endsection