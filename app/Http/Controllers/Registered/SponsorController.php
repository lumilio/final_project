<?php

namespace App\Http\Controllers\Registered;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsor;
use Braintree\Gateway;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsors = Sponsor::all();

        return view('registered.sponsors.index', compact('sponsors'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor, Gateway $gateway)
    {
        // ddd($sponsor);
        $token = $gateway->ClientToken()->generate();

        return view('registered.sponsors.show', compact('sponsor', 'token'));
    }

    public function checkout(Apartment $apartment, Sponsor $sponsor, Gateway $gateway)
    {
        $result = $gateway->transaction()->sale([
            'amount' => $sponsor->price,
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;

            ddd($apartment);

            return redirect()->route('registered.apartments.index')->with('message', "Transazione avvenuta con successo! L'ID della transazione è: $transaction->id");
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('Transazione fallita! Il motivo è: ' . $result->message);
        }
    }
}
