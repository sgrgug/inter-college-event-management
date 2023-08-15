<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cixware\Esewa\Client;
use Cixware\Esewa\Config;
use App\Models\Organization;

class EsewaController extends Controller
{
    public function esewaPay()
    {

        // Set success and failure callback URLs.
        $successUrl = url('/success');
        $failureUrl = url('/failure');

        // Config for development.
        $config = new Config($successUrl, $failureUrl);

        // Config for production.
        // $config = new Config($successUrl, $failureUrl, 'b4e...e8c753...2c6e8b');

        // Initialize eSewa client.
        $esewa = new Client($config);

        $esewa->process(uniqid(), 599, 0, 0, 0);
    }

    public function esewaSuccess()
    {
        $org = Organization::where('user_id', auth()->user()->id)->first();

        $org->prosub = true;
        $org->update();

        return redirect()->route('proSubscription')->with('status', 'Payment Successful');
    }
    public function esewaFailure()
    {
        return redirect()->route('proSubscription')->with('status', 'Payment Failure');
    }
}
