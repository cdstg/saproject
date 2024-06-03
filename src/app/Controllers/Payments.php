<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class Payments extends BaseController
{
    /**
     * @return string
     * @throws ApiErrorException
     *
     * Show the successful payment page
     */
    public function payment_success()
    {

        /** @todo handle exceptions */
        $stripe = new StripeClient(getenv('STRIPE_SECRET_KEY'));

        $intent_id = $this->request->getGet('payment_intent');

        $intent = $stripe->paymentIntents->retrieve($intent_id);

        //since the intent does not have the nilling details we need to call the charge API
        /** @todo handle exceptions */
        $chargedetails = $stripe->charges->retrieve($intent->latest_charge, []);
        $email = $chargedetails->billing_details->email;

        $data = [];
        $data['intent_id'] = $intent_id;
        $data['amount'] = $intent->amount_received;
        $data['email'] = $email;

        return view('success', $data);
        exit;

    }

}
