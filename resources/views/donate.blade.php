@extends('layouts.app')

@section('title', 'Make a Donation')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="text-center mb-0">Donate to Help Us</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('make.payment') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Donation Amount (₹)</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Proceed to Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
