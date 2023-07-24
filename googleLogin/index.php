<?php
require_once('auth.php');
require_once('vendor/autoload.php');
require_once('config.php');

$google_client = new Google_Client();
$google_client->setClientId(CLIENT_ID);
$google_client->setClientSecret(CLIENT_SECRET);
$google_client->setRedirectUri(REDIRECT_URL);

$google_client->addScope('email');
$google_client->addScope('profile');

if (isset($_GET['code'])) {
  $token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);

  if (!isset($token['error'])) {
    $google_client->setAccessToken($token['access_token']);
    $_SESSION['access_token'] = $token['access_token'];
    $google_service = new Google_Service_Oauth2($google_client);

    $udata = $google_service->userinfo->get();
    foreach ($udata as $key => $value) {
      $_SESSION['login_' . $key] = $value;
    }
    $_SESSION['ucode'] = $_GET['code'];
    header('location: ./');
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title text-center">Login</h2>
            <form>

              <div class="container my-5">
                <div class="row">
                  <div class="col-auto mx-auto">
                    <a href="<?= $google_client->createAuthUrl() ?>" class="btn btn btn-danger "><i
                        class="fab fa-google me-2"></i>Login with Google</a>
                  </div>
                </div>
              </div>

            </form>


          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (Optional, for additional functionality) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Font Awesome (Optional, for Google icon) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

</body>

</html>