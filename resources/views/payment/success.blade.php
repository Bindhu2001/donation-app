@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h3 class="text-center mb-0">Thank You for Your Donation!</h3>
            </div>
            <div class="card-body text-center">
                <p class="lead">Your donation of <strong>₹{{ $amount }}</strong> has been successfully processed.</p>
                <p>Transaction ID: <strong>{{ $amount }}</strong></p>

                <a href="/" class="btn btn-primary">Go Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
