<?php
require 'vendor/autoload.php';

// MongoDB connection function
require 'connection.php';

function createDirectoriesIfNotExist() {
    // Directory where PDFs and cover images should be stored in the parent directory
    $imageDirectory = '/images';


    if (!file_exists($imageDirectory)) {
        mkdir($imageDirectory, 0777, true);
    }
}
// User registration function
function registerUser($username, $email, $password, $image) {
    $client = connectToMongoDB();
    $db = $client->mongoTestdb; 

    // Check if the email is already registered
    $collection = $db->user_info;
    $existingUser = $collection->findOne(['email' => $email]);
    if ($existingUser) {
        header("Location: register.php?error='Email is already exists. Could not register. Try again.'");
        exit;
    }

    createDirectoriesIfNotExist(); // Create directories if they don't exist

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if an image was uploaded
    if ($image["error"] == UPLOAD_ERR_OK) {
        $imageDirectory = 'images/';
        $imageName = uniqid() . '_' . $image['name'];
        $imagePath = $imageDirectory . $imageName;

        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Image uploaded successfully, now store the image path in the database
            $result = $collection->insertOne([
                'username' => $username,
                'email' => $email,
                'image' => $imagePath,
                'password' => $hashedPassword,
            ]);

            if ($result->getInsertedCount() > 0) {
                header("Location: login.php?success='Registered Successfully! Login to continue.'");
            } else {
                header("Location: register.php?error='Could not register. Try again.'");
            }
        } else {
            header("Location: register.php?error='Failed to upload the image.'");
        }
    } else {
        // No image uploaded, insert user without an image path
        $result = $collection->insertOne([
            'username' => $username,
            'email' => $email,
            'image' => null, 
            'password' => $hashedPassword,
        ]);

        if ($result->getInsertedCount() > 0) {
            header("Location: login.php?success='Registered Successfully! Login to continue.'");
        } else {
            header("Location: register.php?error='Could not register. Try again.'");
        }
    }
}


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $image = $_FILES["image"];

    registerUser($username, $email, $password, $image);
   
}
?>
