<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;


class Checkout extends BaseController
{
    /**
     * @return string
     * @throws ApiErrorException
     *
     * Create an intent for the product they have selected
     *
     */
    public function index()
    {

        $data = [];
        $item = $this->request->getGet('item');

        $data['id'] = $item;
        $data['error'] = false;
        $data['checkoutjs'] = "";

        switch ($item) {
            case "1":
                $data['title'] = 'The Art of Doing Science and Engineering';
                $data['amount'] = 2300;
                break;
            case "2":
                $data['title'] = 'The Making of Prince of Persia: Journals 1985-1993';
                $data['amount'] = 2500;
                break;
            case "3":
                $data['title'] = 'Working in Public: The Making and Maintenance of Open Source';
                $data['amount'] = 2800;
                break;
            default:
                $data['title'] = "";
                $data['amount'] = 0;
                $data['error'] = 'No item selected';
        }


        //now create an intent
        if ($data['error'] == false) {

            $stripe = new StripeClient(getenv('STRIPE_SECRET_KEY'));

            /** @todo handle exceptions */
            $intent = $stripe->paymentIntents->create(
                array(
                    'amount' => $data['amount'],
                    'currency' => 'USD',
                    'description' => $data['title'],
                    'automatic_payment_methods' => array('enabled' => true),
                    'metadata' => array(
                        'product_id' => $data['id'],
                    ),
                )
            );

            $checkoutjs = view('checkoutjs', ['clientSecret' => $intent->client_secret,
                'publishKey' => getenv('STRIPE_PUBLISHABLE_KEY')
            ],
            );

            $data['checkoutjs'] = $checkoutjs;
        }

        return view('checkout', $data);
    }

}
