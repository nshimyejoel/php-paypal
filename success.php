<?php
require_once 'config.php';
 
if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
    $payment_id = $_GET['paymentId'];
    $payer_id = $_GET['PayerID'];
 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- PayPal Icons -->
    <link href="https://www.paypalobjects.com/webstatic/icon/pp258.png" rel="icon">
    <style>
        .paypal-icon {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="https://www.paypalobjects.com/webstatic/icon/pp258.png" alt="PayPal" class="paypal-icon">
                        <h5 class="card-title mt-4">Payment Successful</h5>
                        <p class="card-text">Your payment has been successfully processed.</p>
                        <p class="card-text"><b>Transaction ID:</b> <?php echo $payment_id?></p>
                        <a href="index.php" class="btn btn-primary">Continue to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

 <?php
    
} else {
    echo 'Transaction is declined';
}