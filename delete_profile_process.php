<?php
require 'vendor/autoload.php'; // Include the Composer autoloader for MongoDB

// MongoDB connection function (similar to the one we used before)
require 'connection.php';
session_start();
function deleteProfile()
{
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; // Replace with your database name
    $collection = $db->user_info;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $_POST["email"];
        $password = $_POST["password"];
        // Find the user by email
        $user = $collection->findOne(['email' => $email]);

        if ($user && password_verify($password, $user->password)) {

        }
        $deleteResult = $collection->deleteOne(['_id' => $user->_id]);
        $res = $deleteResult->getDeletedCount();
        // var_dump($res);
        echo $res;
        if ($res == 1) {
            header("Location: login.php?success='Account deleted successfully. Login or sign up to continue.'");
        
            session_unset();
            session_destroy();
            exit;
        } else {
            header("Location: delete_profile.php?error='Could not delete account. Check email or password again.'");
            exit;
        }
    }
}
        deleteProfile();
?>