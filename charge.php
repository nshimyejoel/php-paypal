<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

use GuzzleHttp\Client;

if (isset($_POST['submit'])) {
    $amount = $_POST['amount'];

    $auth_url = 'https://api.sandbox.paypal.com/v1/oauth2/token';
   
    $client = new Client();

    $auth_response = $client->request('post', $auth_url, ['auth' => [CLIENT_ID,CLIENT_SECRET],'form_params' => ['grant_type' => 'client_credentials'], 'headers' => [ 'Accept' => 'application/json', 'Accept-Language' => 'en_US', ]]);

    $auth_data = json_decode($auth_response->getBody(), true);

    if (isset($auth_data['access_token'])) {
        $access_token = $auth_data['access_token'];

        $create_payment_url = 'https://api.sandbox.paypal.com/v1/payments/payment';
        
        $payment_data = [
            'intent' => 'sale',
            'payer' => ['payment_method' => 'paypal'],
            'transactions' => [
                [
                    'amount' => [
                        'total' => $amount,
                        'currency' => PAYPAL_CURRENCY
                    ]
                ]
            ],
            'redirect_urls' => [
                'return_url' => PAYPAL_RETURN_URL,
                'cancel_url' => PAYPAL_CANCEL_URL
            ]
        ];

        $payment_response = $client->request('post', $create_payment_url, ['headers' => [ 'Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $access_token ],'json' => $payment_data ]);

        $payment_data = json_decode($payment_response->getBody(), true);

        if (isset($payment_data['id'])) {
            $payment_id = $payment_data['id'];

            $approval_url = null;
            foreach ($payment_data['links'] as $link) {
                if ($link['rel'] === 'approval_url') {
                    $approval_url = $link['href'];
                    break;
                }
            }

            if ($approval_url) {
                header("Location: $approval_url");
                exit;
            } else {
                echo "Failed to obtain PayPal approval URL.";
            }
        } elseif (isset($payment_data['error']) && isset($payment_data['error_description'])) {
            echo "Payment creation failed: " . $payment_data['error_description'];
        } else {
            echo "Payment creation failed. Error Response: ";
        }
    } elseif (isset($auth_data['error']) && isset($auth_data['error_description'])) {
        echo "Failed to obtain PayPal access token: " . $auth_data['error_description'];
    } else {
        echo "Failed to obtain PayPal access token. Error Response: ";
    }
}
