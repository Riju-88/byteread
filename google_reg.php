<?php
require_once 'vendor/autoload.php';
require 'connection.php';
session_start(); // Start the session
function createDirectoriesIfNotExist()
{
    // Directory where PDFs and cover images should be stored in the parent directory
    $imageDirectory = '/images';


    if (!file_exists($imageDirectory)) {
        mkdir($imageDirectory, 0777, true);
    }
}
// User registration function
function registerUser($google_username, $google_email, $google_password, $google_image)
{
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; 

    // Check if the email is already registered
    $collection = $db->user_info;
    $existingUser = $collection->findOne(['email' => $google_email]);

    if ($existingUser) {

        // User exists, log in the user
        $_SESSION['user'] = serialize($existingUser); // Store user data in the session
        header("Location: index.php"); // Redirect to the homepage
        
        exit;
    }

    createDirectoriesIfNotExist(); // Create directories if they don't exist

    // Hash the password for security
    $hashedPassword = password_hash($google_password, PASSWORD_DEFAULT);

    // Check if an image URL is available
    if (!empty($google_image)) {
        // get the image content
        $imageContent = file_get_contents($google_image);

        // save it in the 'images' directory
        $imageDirectory = 'images/';
        $imageName = uniqid() . '_google_image.jpg'; // modify the file extension based on the image format

        $imagePath = $imageDirectory . $imageName;

        // Save the image to the local directory
        if (file_put_contents($imagePath, $imageContent)) {
            // Image saved successfully, store the image path in the database
            $result = $collection->insertOne([
                'username' => $google_username,
                'email' => $google_email,
                'image' => $imagePath,
                'password' => $hashedPassword,
            ]);

            if ($result->getInsertedCount() > 0) {
                $user = $collection->findOne(['email' => $google_email]);
                $_SESSION['user'] = serialize($user); // Store user data in the session
               
                header("Location: index.php"); // Redirect to the homepage
               
                exit;
            } else {
                header("Location: register.php?error='Could not register. Try again.'");
                exit;
            }
        } else {
            header("Location: register.php?error='Failed to save the image.'");
            exit;
        }
    } else {
        // No image URL available, insert user without an image path
        $result = $collection->insertOne([
            'username' => $google_username,
            'email' => $google_email,
            'image' => null,
            'password' => $hashedPassword,
        ]);

        if ($result->getInsertedCount() > 0) {
            $user = $collection->findOne(['email' => $google_email]);
            $_SESSION['user'] = serialize($user); // Store user data in the session
           
            header("Location: index.php"); // Redirect to the homepage
           
            exit;
        } else {
            header("Location: register.php?error='Could not register. Try again.'");
           
            exit;
        }
    }

}


// Check if Google user data is present in the session
if (isset($_SESSION['google_user'])) {


    // Retrieve and unserialize the Google user data
    $google_user_data = unserialize($_SESSION['google_user']);

    // Initialize MongoDB connection function
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; 

    // Extract Google user data
    $google_email = $google_user_data->email;
    $google_name = $google_user_data->name;
    $google_image = $google_user_data->picture;
    // Check if the email is already registered
    $collection = $db->user_info;
    $existingUser = $collection->findOne(['email' => $google_email]);


    // User does not exist, proceed with registration
    createDirectoriesIfNotExist(); // Create directories if they don't exist

    // Generate a unique username based on the Google name or use a different approach
    $google_username = $google_name;

    // Hash a random password for the user
    $google_password = password_hash(bin2hex(random_bytes(8)), PASSWORD_DEFAULT);


    // Define $google_image here to make it accessible to the registerUser function
$google_image = isset($google_image) ? $google_image : null;

    // Perform the registration here with the Google data
    registerUser($google_username, $google_email, $google_password, $google_image);

    // unset the session variable after processing
    unset($_SESSION['google_user']);

}
?>