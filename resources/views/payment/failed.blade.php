@extends('layouts.app')

@section('title', 'Payment Failed')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white">
                <h3 class="text-center mb-0">Payment Failed</h3>
            </div>
            <div class="card-body text-center">
                <p class="lead">Oops! Something went wrong while processing your payment.</p>
                <p>Please try again later.</p>

                <a href="/donate" class="btn btn-warning">Try Again</a>
            </div>
        </div>
    </div>
</div>
@endsection
