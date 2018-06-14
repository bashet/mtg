@extends('layouts.app')

@push('scripts')
    <script>
        $(function () {
            $('.chosen-select').chosen();

            $('#carouselchoose').change(function (e) {
                axios.get('/mtg/get_card_set_by_code/' + this.value)
                    .then((result) => {

                    });
            });
        });
    </script>
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
                                <a id="seticon" href="#" class="btn btn-link"><i class="ss ss-{{$first_set->code}} ss-grad ss-3x"></i></a>
                                <a id="acards" href="#" class="btn btn-link">{{$first_set->cards->sum('qty')}}</a>
                                <a id="tcards" href="#" class="btn btn-link">{{$first_set->cards->count()}}</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div class="card-body bg-dark">
                        @include('mtg::carousel', ['cards' => $cards])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection