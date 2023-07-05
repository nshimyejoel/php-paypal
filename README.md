# php-paypal

#This is a php applications that accepts online payments using paypal

#First of all you have to create a paypal account 
To create a PayPal account and sandbox, you need to go to developer.paypal.com and sign up. Once you have created a PayPal account, you can access your sandbox account by clicking the "Sandbox" tab. If you do not already have a sandbox account, you can create one by clicking the "Create Account" button. After you create a sandbox account, you will be given a client ID and secret. These are the credentials that you will use to access the PayPal API in your testing environment. You can then start testing your application in the PayPal sandbox. Once you are satisfied with your testing, you can switch your application to the live environment.

#Install xampp and create a directory called paypal in htdocs directory
#I used the Omnipay package for PayPal REST API integration

#Install the library using the following commands:

composer require league/omnipay omnipay/paypal
