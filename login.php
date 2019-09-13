<?php include('server.php') ?>
<!DOCTYPE html>
<html>
	<head>
	    <title>SciTings - Login</title>
	    <link rel="stylesheet" type="text/css" href="css/signin.css">
	    <?php readfile("dependencies.html"); ?>
	 </head>

 	<body style="background-color:#e9ecef;">
    	<div id="container">
      		<?php include("navbar.php"); ?>
      	</div>
      	<div class="container">
	      <div class="row">
	        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
	          <div class="card card-signin my-5">
	            <div class="card-body">
	              <h5 class="card-title text-center">Login</h5>
	              <form class="form-signin" action="login.php" method="post">
	              	<?php include('errors.php'); ?>
	                <div class="form-label-group">
	                  <input type="text" name="username" id="username" class="form-control" placeholder="Username">
	                  <label for="username">Username</label>
	                </div>

	                <div class="form-label-group">
	                  <input type="password" name="password" id="password" class="form-control" placeholder="Password">
	                  <label for="password">Password</label>
	                </div>

	                <div class="custom-control custom-checkbox mb-3">
	                  <input type="checkbox" class="custom-control-input" id="customCheck1">
	                  <label class="custom-control-label" for="customCheck1">Remember password</label>
	                </div>
	                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="login_user">Login</button>
	                <hr class="my-4">
	                <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
	                <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button>

	                 <hr class="my-4">
	                <p align="center">
    	              Don't have an account? <a href="register.php">Register</a>
        	        </p>
                
	              </form>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
	</body>
</html>
