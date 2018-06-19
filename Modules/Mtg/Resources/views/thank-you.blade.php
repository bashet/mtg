@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>Order submitted</h1>
        <h2>Order ID: {{$order->id}}</h2>
    </div>
@endsection