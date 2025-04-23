<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Donation;

class DonationController extends Controller
{
    public function showForm()
    {
        return view('donate');
    }

    public function makePayment(Request $request)
    {
        $donation = Donation::create($request->all());

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $order = $api->order->create([
            'receipt' => 'DONATION_' . $donation->id,
            'amount' => $donation->amount * 100,
            'currency' => 'INR'
        ]);

        return view('razorpay-checkout', [
            'order_id' => $order['id'],
            'amount' => $donation->amount,
            'name' => $donation->name,
            'email' => $donation->email,
            'donation_id' => $donation->id
        ]);
    }

    public function paymentSuccess(Request $request)
    {
        $paymentId = $request->input('payment_id');
        $donationId = $request->input('donation_id');
    
        // Fetch the donation from the database
        $donation = Donation::find($donationId);
    
        // Initialize Razorpay API
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
    
        try {
            // Fetch payment details using Razorpay API
            $payment = $api->payment->fetch($paymentId);
    
            // Check if payment is successful
            if ($payment->status == 'captured') {
                // Update donation status to successful
                $donation->status = 'Success';
                $donation->payment_id = $paymentId;
                $donation->save();
    
                // Redirect to success page
                return redirect()->route('payment.success');
            } else {
                // Handle failed payment
                $donation->status = 'Failed';
                $donation->payment_id = $paymentId;
                $donation->save();
    
                return redirect()->route('payment.failed');
            }
        } catch (\Exception $e) {
            // Handle API errors
            return redirect()->route('payment.failed');
        }
    }
}
