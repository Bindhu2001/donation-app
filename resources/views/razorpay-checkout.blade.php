@extends('layouts.app')

@section('title', 'Donation Checkout')

@section('content')
<!-- Your Razorpay Checkout HTML and Button -->
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="text-center mb-0">Make a Donation</h3>
            </div>
            <div class="card-body text-center">
                <p>You are about to donate <strong>₹{{ $amount }}</strong></p>

                <form method="POST" action="/payment-success" id="payment-form">
                    @csrf
                    <input type="hidden" name="donation_id" value="{{ $donation_id }}">
                    <input type="hidden" name="payment_id" id="payment_id">
                </form>

                <button id="rzp-button" class="btn btn-primary">
                    Pay with Razorpay
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Razorpay Checkout Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ config('services.razorpay.key') }}",  // Razorpay API Key
        "amount": "{{ $amount * 100 }}",  // Convert amount to paise
        "currency": "INR",
        "name": "Donation",
        "description": "Donation for Charity",
        "order_id": "{{ $order_id }}", // Razorpay order ID
        "handler": function (response) {
            // On successful payment, handle payment success
            document.getElementById('payment_id').value = response.razorpay_payment_id;
            document.getElementById('payment-form').submit();  // Submit the form after payment
        },
        "prefill": {
            "name": "{{ $name }}",
            "email": "{{ $email }}"
        },
        "theme": {
            "color": "#0d6efd"  // Razorpay button color
        }
    };

    var rzp = new Razorpay(options);

    // Add event listener to open Razorpay modal
    document.getElementById('rzp-button').addEventListener('click', function (e) {
        e.preventDefault();  // Prevent the default button click action
        rzp.open();  // Open the Razorpay checkout modal
    });
</script>
@endsection
