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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- favicon -->
    <?php include 'favicon.php'; ?>
    <link rel="stylesheet" href="../css/output.css">

</head>
<body>
    <!-- Navigation -->
    <?php include 'navbar.php'; ?>

   <!-- alert -->
   <?php require '../alert.php'; ?>

    <div class="hero min-h-screen bg-base-200">
  <div class="hero-content flex-col lg:flex-row">
    <div class="text-center lg:text-left">
      
    </div>
    <form action="update_profile_process.php" method="post" class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100" enctype="multipart/form-data">
      
      <div class="card-body">
        
       <h2 class="text-2xl font-bold text-center">Update Profile</h2>
        <div class="form-control">
          <label for="email" class="label">
            <span class="label-text">ID:</span>
          </label>
          <input type="text" id="admin_id" name="admin_id" value="<?php echo $admin->_id; ?>" readonly placeholder="ID" class="input input-bordered">
        </div>
        <div class="form-control">
          <label for="email" class="label">
            <span class="label-text">Email:</span>
          </label>
          <input type="email" id="email" name="email" value="<?php echo $admin->email; ?>" readonly placeholder="Email" class="input input-bordered">
        </div>
        <div class="form-control">
          <label for="password" class="label">
            <span class="label-text">New Password:</span>
          </label>
          <input type="password" id="password" name="password" required placeholder="New Password" class="input input-bordered">
        </div>
        <div class="form-control">
          <label for="profile_image" class="label">
            <span class="label-text">Profile Image:</span>
          </label>
          <input type="file" id="profile_image" name="profile_image" placeholder="Profile Image" class="file-input file-input-bordered file-input-primary w-full" accept="image/*">
        </div>
        <div class="form-control mt-6">
          <input type="submit" value="Update Profile" class="btn btn-primary">
        </div>
      </div> 
      
    </form>
   
  </div>
</div>

   <!-- Footer -->
  
</body>
</html>
