<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['admin'])) {
  // User is not logged in, redirect to the login page
  header("Location: login.php");
  exit();
}

require '../vendor/autoload.php'; // Include the Composer autoloader for MongoDB

// Unserialize the user object
$admin = unserialize($_SESSION['admin']);

?>

<?php 
require 'manage_users_process.php'; // Include the logic file
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <!-- favicon -->
    <?php include 'favicon.php'; ?>

    <link rel="stylesheet" href="../css/output.css">

</head>

<body>

    <!-- Navigation -->
   <?php include 'navbar.php'; ?>

    <!-- alert -->
    <?php require '../alert.php'; ?>
    <?php 
          $sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';
          $nameNextSort = ($sortBy === 'name_asc') ? 'name_desc' : 'name_asc';
          $emailNextSort = ($sortBy === 'email_asc') ? 'email_desc' : 'email_asc';
    ?>

    <div class="overflow-x-auto">
    <table class="table table-sm">
      <thead>
        <tr class="bg-base-200">
          <th class="text-lg text-gray-300">Icon</th>
          <th class="text-lg text-gray-300"><a href='manage_users.php?sort=<?php echo $nameNextSort; ?>'
              class="link">Username</a></th>
          <th class="text-lg text-gray-300"><a href='manage_users.php?sort=<?php echo $emailNextSort; ?>'
              class="link">Email</a></th>
         
          <th class="text-lg text-gray-300">Delete</th>
        </tr>
      </thead>
      <tbody>

    <?php
   
    
// Fetch all registered users 
$sortBy = $_GET['sort'] ?? null;
$users = getAllUsers($sortBy);

// Check if there are users to display
if (!empty($users)) {
   
    foreach ($users as $user) {
        echo '<tr class="hover:bg-primary hover:text-red-900">';
        echo '<td>';
        echo ' <div class="flex items-center space-x-3">
        <div class="avatar">
          <div class="rounded-box w-16 h-16">';
        // Check if the user has an image
        if ($user->image != null) {
            echo '<img src="../' . $user->image .'" alt="User Icon" />';
        } else {
            echo '<img src="" alt="User Icon" />';
        }
        echo '</div></div><div>';
        echo '</td>';
        echo '<td>'.trim($user->username).'</td>';
        echo '<td class="font-bold">'.trim($user->email).'</td>';
        $user_str = serialize($user);
        $encoded_user_str = urlencode($user_str);
        echo '<td><a href="delete_user.php?user_data=' . $encoded_user_str . '" class="btn btn-error">Delete</a></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo '<p>No registered users found.</p>';
}
?>


</body>

</html>