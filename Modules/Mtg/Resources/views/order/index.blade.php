@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="card">
            <div class="card-header">
                <h3 class="card-title">Orders</h3>
            </div>
            <div class="card-block">
                <table class="table table-bordered table-hover" style="width: 100%">
                    <thead>
                    <tr>
                        <th class="text-center">Date</th>
                        <th>Name</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Paid</th>
                        <th class="text-center">Destination</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="text-center">{{$order->created_at->format('d/m/Y')}}</td>
                            <td>{{$order->name}}</td>
                            <td class="text-center">{{$order->statuses->count() ? $order->statuses->last()->status->name : ''}}</td>
                            <td class="text-center"><i class="fas fa-{{$order->paid ? 'check' : 'times'}}"></i></td>
                            <td class="text-center">{{$order->city}} - {{$order->postcode}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection