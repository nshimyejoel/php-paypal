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

2. Install PHP to your computer:
   - Download and install [PHP](https://www.php.net/downloads.php) if you haven't already.
   - [PHP](https://www.php.net/downloads.php) version  must be  8.1.17 or higher
   
3. Install Composer:
   - Visit [getcomposer](https://getcomposer.org/download/) and follow the instructions to download and install Composer based on your operating system if you haven't already.

## Installation
To integrate PayPal REST API functionality into your PHP application, we will be using the `Omnipay` package. Follow the steps below to install the library:

1. Navigate to the directory where you want to create the `paypal` directory and create the directory.
2. Open  terminal or command prompt.
3. Navigate to the `paypal` directory  created in step 1.
4. Clone the project to `paypal` directory
5. Run the following command to install the required packages:

```bash
composer require league/omnipay omnipay/paypal
```
 Composer will download and install the necessary dependencies

6. Open the `config.php` file in a text editor make the following changes

```php
define('CLIENT_ID', 'your sandbox client_id');
define('CLIENT_SECRET', 'your sandbox client_secret');

```
Replace `your sandbox client_id` and `your sandbox client_secret` with the client ID and secret you obtained from the PayPal sandbox environment.

## Usage
Now, your PHP application is set up with the required dependencies using Composer, and you can start using PayPal REST API for online payments.

### instructions on how to start the Built-in web server for PHP

- Open  terminal or command prompt.
- Navigate to the `paypal` directory
- Run the following to start built-in web server
```bash
php -S localhost:800
```
  The terminal will show
  ```bash
  PHP 8.1.17 Development Server started at Thu Jul 7 10:43:28 2023
  Listening on http://localhost:800
  Document root is /home/computer/paypal
  Press Ctrl-C to quit
  ```

- Open your web browser and navigate to http://localhost:800 to access the application.




 
