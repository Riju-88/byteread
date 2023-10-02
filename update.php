<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['user'])) {
  // User is not logged in, redirect to the login page
  header("Location: login.php");
  exit();
}

require 'vendor/autoload.php'; // Include the Composer autoloader for MongoDB

// Unserialize the user object
$user = unserialize($_SESSION['user']);

// Now you can access properties of $user, such as $user->_id
$user_id = $user->_id;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Profile</title>
  <!-- favicon -->
  <?php include 'favicon.php'; ?>
  <link rel="stylesheet" href="css/output.css">

</head>

<body>
  <!-- Navigation -->
  <?php include 'navbar.php'; ?>

  <!-- alert -->
  <?php require 'alert.php'; ?>

  <div class="hero min-h-screen bg-base-200">
    <div class="hero-content flex-col lg:flex-row">



      <form action="update_process.php" method="post" class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100"
        enctype="multipart/form-data">
        <div class="card-body">
          <h2 class="text-2xl font-bold text-center">Update Profile</h2>
          <?php
          // Check if the user has an image
          if ($user->image != null) {
            // Display the user's image
            echo '<div class="form-control"><img src="' . $user->image . '" alt="Image" class="rounded-box h-24 w-24 mx-auto mb-4"></div>';
          }
          ?>
          <div class="form-control">
            <label for="username" class="label">
              <span class="label-text">Username:</span>
            </label>
            <input type="text" id="username" name="username" value="<?php echo $user->username; ?>" required
              placeholder="Username" class="input input-bordered">
          </div>
          <div class="form-control">
            <label for="email" class="label">
              <span class="label-text">Email:</span>
            </label>
            <input type="email" id="email" name="email" value="<?php echo $user->email; ?>" readonly placeholder="Email"
              class="input input-bordered">
          </div>
          <div class="form-control">
            <label for="password" class="label">
              <span class="label-text">New Password:</span>
            </label>
            <input type="password" id="password" name="password" required placeholder="New Password"
              class="input input-bordered">
          </div>
          <div class="form-control">
            <label for="profile_image" class="label">
              <span class="label-text">Profile Image:</span>
            </label>
            <input type="file" id="profile_image" name="profile_image" placeholder="Profile Image"
              class="file-input file-input-bordered file-input-primary w-full" accept="image/*">
          </div>
          <div class="form-control mt-6">
            <input type="submit" value="Update Profile" class="btn btn-primary">
          </div>
        </div>
        <div class="mt-6 flex justify-center mb-6">
          <a class="btn btn-error w-5/6" href="delete_profile.php">Delete Profile</a>
        </div>
      </form>

    </div>
  </div>

  <!-- Footer -->
  <?php include 'footer.php'; ?>
</body>

</html>