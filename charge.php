<?php
require_once 'config.php';

if (isset($_POST['submit'])) {
    $amount = $_POST['amount'];


    $authUrl = 'https://api.sandbox.paypal.com/v1/oauth2/token';
    $clientId = urlencode(CLIENT_ID);
    $clientSecret = urlencode(CLIENT_SECRET);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $authUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $clientId . ':' . $clientSecret);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');

    $headers = [
        'Accept: application/json',
        'Accept-Language: en_US',
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $authResponse = curl_exec($ch);
    $authData = json_decode($authResponse, true);

    if (isset($authData['access_token'])) {
        $accessToken = $authData['access_token'];


        $createPaymentUrl = 'https://api.sandbox.paypal.com/v1/payments/payment';
        $returnUrl = PAYPAL_RETURN_URL;
        $cancelUrl = PAYPAL_CANCEL_URL;

        $paymentData = [
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
                'return_url' => $returnUrl,
                'cancel_url' => $cancelUrl
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $createPaymentUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $accessToken
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));

        $paymentResponse = curl_exec($ch);
        $paymentData = json_decode($paymentResponse, true);

        if (isset($paymentData['id'])) {
            $paymentId = $paymentData['id'];


            $approvalUrl = null;
            foreach ($paymentData['links'] as $link) {
                if ($link['rel'] === 'approval_url') {
                    $approvalUrl = $link['href'];
                    break;
                }
            }

            if ($approvalUrl) {
                header("Location: $approvalUrl");
                exit;
            } else {
                echo "Failed to obtain PayPal approval URL.";
            }
        } elseif (isset($paymentData['error']) && isset($paymentData['error_description'])) {
            echo "Payment creation failed: " . $paymentData['error_description'];
        } else {
            echo "Payment creation failed. Error Response: ";

        }
    } elseif (isset($authData['error']) && isset($authData['error_description'])) {
        echo "Failed to obtain PayPal access token: " . $authData['error_description'];
    } else {
        echo "Failed to obtain PayPal access token. Error Response: ";

    }
}
?>