@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card" style="width: 100%">
            <div class="card-header">
                <h3 class="card-title">Registration Completed</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <i class="fas fa-check fa-8x"></i>
                    </div>
                    <div class="col-sm-8">
                        <p>
                            You have successfully registered and verified your account.
                        </p>
                        <p>Now you can login to your account.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
