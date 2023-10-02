<?php
require 'vendor/autoload.php'; // Include the Composer autoloader for MongoDB

// MongoDB connection function
require 'connection.php';

// Login function
function loginUser($email, $password)
{
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; 
    $collection = $db->user_info;

    // Find the user by email
    $user = $collection->findOne(['email' => $email]);

    if ($user && password_verify($password, $user->password)) {
        // Password is correct, user is authenticated

        // Start or resume the session after a successful login
        session_start();


        // Store user data in session after serializing it
        $_SESSION['user'] = serialize($user);


        return true;
    } else {
        // Invalid credentials
        return false;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (loginUser($email, $password)) {
        // Redirect to a success page or perform other actions
        header("Location: index.php");
        //var_dump($_SESSION); // Debug session data
        exit;
    } else {
        // Display an error message or redirect to a login page with an error
        header("Location: login.php?error='Invalid credentials. Please try again.'");
        exit;
    }
}
?>

