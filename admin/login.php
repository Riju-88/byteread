<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- favicon -->
    <?php include 'favicon.php'; ?>
    <link rel="stylesheet" href="../css/output.css">
</head>
<body>

 <!-- alert -->
 <?php require '../alert.php'; ?>
 
<!-- <div class="hero min-h-screen bg-base-200">
  <div class="hero-content flex-col lg:flex-row">
    <div class="text-center lg:text-left">
      <h2 class="text-5xl font-bold">Admin Login</h2>
    </div>
    <form action="login_process.php" method="post" class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
      <div class="card-body">
        <div class="form-control">
          <label for="email" class="label">
            <span class="label-text">Email:</span>
          </label>
          <input type="email" id="email" name="email" required placeholder="Email" class="input input-bordered">
        </div>
        <div class="form-control">
          <label for="password" class="label">
            <span class="label-text">Password:</span>
          </label>
          <input type="password" id="password" name="password" required placeholder="Password" class="input input-bordered">
        </div>
        <div class="form-control mt-6">
          <input type="submit" value="Login" class="btn btn-primary">
        </div>
      </div>
    </form>
  </div>
</div> -->


 
 
<div class="hero min-h-screen bg-base-200">
  <div class="hero-content flex-col lg:flex-row">
    <div class="card flex-shrink-0 w-full max-w-sm">
      <div class="card-body">
        <div class="text-center mb-4">
          <h1 class="text-4xl font-bold p-4">Login</h1>
        </div>
        <div class="card shadow-2xl bg-base-100">
          <div class="card-body">
            <!-- Login form here -->
            <form action="login_process.php" method="post">
              <div class="form-control">
                <label class="label">
                  <span class="label-text">Email</span>
                </label>
                <input type="email" name="email" placeholder="Email" class="input input-bordered bg-base-100" required>
              </div>
              <div class="form-control">
                <label class="label">
                  <span class="label-text">Password</span>
                </label>
                <input type="password" name="password" placeholder="Password" class="input input-bordered bg-base-200" required>
                <label class="label">
                  <a href="#" class="label-text-alt link link-hover">Forgot password?</a>
                </label>
              </div>
              <div class="form-control mt-6">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
            <!-- End of Login Form -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
