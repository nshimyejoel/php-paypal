<?php
require_once 'config.php';

if (isset($_POST['submit'])) {
    $amount = $_POST['amount'];


    $auth_url = 'https://api.sandbox.paypal.com/v1/oauth2/token';
    $client_id = urlencode(CLIENT_ID);
    $client_secret = urlencode(CLIENT_SECRET);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $auth_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $client_id . ':' . $client_secret);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');

    $headers = [
        'Accept: application/json',
        'Accept-Language: en_US',
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $auth_response = curl_exec($ch);
    $auth_data = json_decode($auth_response, true);

    if (isset($auth_data['access_token'])) {
        $access_token = $auth_data['access_token'];


        $create_payment_url = 'https://api.sandbox.paypal.com/v1/payments/payment';
        $return_url = PAYPAL_RETURN_URL;
        $cancel_url  = PAYPAL_CANCEL_URL;

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
                'return_url' => $return_url,
                'cancel_url' => $cancel_url 
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $create_payment_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $access_token
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payment_data));

        $payment_response = curl_exec($ch);
        $payment_data = json_decode($payment_response, true);

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
?>