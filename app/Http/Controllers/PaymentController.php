<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        $donation = Donation::find($request->input('donation_id'));

        return view('payment.success', [
            'name' => $donation->name ?? 'Guest',
            'amount' => $donation->amount ?? 0
        ]);
    }

    public function failed()
    {
        return view('payment.failed');
    }
}
