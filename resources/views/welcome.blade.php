@extends('layouts.app')

@push('scripts')
    <script>
        $(function () {
            $('.chosen-select').chosen();
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
                        {!! Form::label('carouselchoose', 'Set', ['class' => 'mr-sm-2']) !!}
{{--                        {!! Form::select('search', $sets, '', ['class' => 'form-control chosen-select', 'placeholder' => 'Card search ...']) !!}--}}
                        {!! get_card_select($sets) !!}
                        {!! Form::close() !!}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection