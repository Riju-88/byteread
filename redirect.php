<?php
// require_once 'vendor/autoload.php';

// // init configuration
// $clientID = '790367901050-5f5kkpj7qlbak5062r09jfs4au13s76h.apps.googleusercontent.com';
// $clientSecret = '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';
// $redirectUri = 'http://localhost/byteread/redirect.php';

// // create Client Request to access Google API
// $client = new Google_Client();
// $client->setClientId($clientID);
// $client->setClientSecret($clientSecret);
// $client->setRedirectUri($redirectUri);
// $client->addScope("email");
// $client->addScope("profile");

// try {
//     // authenticate code from Google OAuth Flow
// if (isset($_GET['code'])) {
//     $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
//     $client->setAccessToken($token['access_token']);

//     // get profile info
//     $google_oauth = new Google_Service_Oauth2($client);
//     $google_account_info = $google_oauth->userinfo->get();
//     $email = $google_account_info->email;
//     $name = $google_account_info->name;

//     // Store user data in session after serializing it
//     $_SESSION['google_user'] = serialize($google_account_info);

//     // Now you can use this profile info to create an account on your website and log the user in.
// }
//  else {
//         echo "<a href='" . $client->createAuthUrl() . "'>Google Login</a>";
//     }
// } catch (GuzzleHttp\Exception\RequestException $e) {
//     echo 'Guzzle Request Exception: ' . $e->getMessage();
// } catch (Exception $e) {
//     echo 'General Exception: ' . $e->getMessage();
// }
?>

<?php
require_once 'vendor/autoload.php';

// init configuration
$clientID = '790367901050-5f5kkpj7qlbak5062r09jfs4au13s76h.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost:8081/byteread/redirect.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
$client->addScope("https://www.googleapis.com/auth/userinfo.profile"); // scope for profile image

session_start(); // Start the session

try {
    // Authenticate code from Google OAuth Flow
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        // Get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // Store user data in session after serializing it
        $_SESSION['google_user'] = serialize($google_account_info);

        // Check if the session variable 'google_user' is set
        if (isset($_SESSION['google_user'])) {
            // Redirect to google_reg.php
            header("Location: google_reg.php");
            exit; // exit to prevent further code execution
        }
    } else {
        // If not authenticated, show Google Login link
        header("Location: " . $client->createAuthUrl());
        exit;
    }
} catch (GuzzleHttp\Exception\RequestException $e) {
    echo 'Guzzle Request Exception: ' . $e->getMessage();
} catch (Exception $e) {
    echo 'General Exception: ' . $e->getMessage();
}
?>
