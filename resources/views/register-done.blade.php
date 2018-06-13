@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" style="width: 100%">
        <div class="card-header">
            <h3 class="card-title">Verification Required</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 text-center">
                    <i class="fas fa-exclamation-circle fa-8x"></i>
                </div>
                <div class="col-sm-8">
                    <p>
                        You have successfully registered your account. But your account is currently not activated! You will receive an email with an activation link in it.
                    </p>
                    <p>Please click the activation link to complete the registration process.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
