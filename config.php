<?php
require_once "vendor/autoload.php";

use Omnipay\Omnipay;

define('CLIENT_ID', 'AeQpypMHiyjhYOU98S1CLuwaLwfWv1J9H7leCqgu4RbqDaNk9lpiRWwnyX4wKZmRFIdm59oCzUXgn0mV');
define('CLIENT_SECRET', 'EMOem7RJkXPMv8MPKFteo6KiXBVZ64M_5FxA8B85xU8yM3HXX4T0HHUYQU0qA-je3p6LAepNqQieHYT5');

define('PAYPAL_RETURN_URL', 'http://localhost/paypal/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/paypal/cancel.php');
define('PAYPAL_CURRENCY', 'USD'); // set your currency here


$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live