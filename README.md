# php-paypal

This is a PHP application that allows users to make online payments using PayPal. The application is designed to be easy to use and secure.

## Prerequisites
Before getting started with this application, make sure you have completed the following steps:

1. Create a PayPal Account and Sandbox:
   - Visit [developer.paypal.com](https://developer.paypal.com) and sign up for a PayPal account.
   - Once you have created a PayPal account, access your sandbox account by clicking the "Sandbox" tab.
   - If you don't have a sandbox account, create one by clicking the "Create Account" button.
   - After creating a sandbox account, you will receive a client ID and secret. These credentials are required to access the PayPal API during testing.
   - Start testing your application in the PayPal sandbox environment.
   - Once testing is complete, you can switch your application to the live environment.

2. Install XAMPP and Set Up the Environment:
   - Download and install [XAMPP](https://www.apachefriends.org/index.html) if you haven't already.
   - [XAMPP](https://www.apachefriends.org/index.html) must be 8.1.17 / PHP 8.1.17 or higher
   - Locate the `htdocs` directory in your XAMPP installation.
   - Create a new directory called `paypal` within the `htdocs` directory.
3. Install Composer:
   - Visit [getcomposer](https://getcomposer.org/download/) and follow the instructions to download and install Composer based on your operating system if you haven't already.

## Installation
To integrate PayPal REST API functionality into your PHP application, we will be using the `Omnipay` package. Follow the steps below to install the library:

1. Open  terminal or command prompt.
2. navigate to the `paypal` directory  created in step 2.
3. Run the following command to install the required packages:

```bash
composer require league/omnipay omnipay/paypal
```
  - Composer will download and install the necessary dependencies

4. Open the `config.php` file in a text editor make the following changes

```php
define('CLIENT_ID', 'your sandbox client_id');
define('CLIENT_SECRET', 'your sandbox client_secret');

```
- Replace 'your sandbox client_id' and 'your sandbox client_secret' with the client ID and secret you obtained from the PayPal sandbox environment.

## Usage
Now, your PHP application is set up with the required dependencies using Composer, and you can start using PayPal REST API for online payments.

- Start your XAMPP server.
- Open your web browser and navigate to http://localhost/paypal to access the application.




 
