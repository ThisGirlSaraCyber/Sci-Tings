<?php include('server.php') ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="css/registration.css">
      
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      
    <?php readfile("dependencies.html"); ?>
  </head>
  <body>
    <div id="container">
          <?php include("navbar.php"); ?>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">
              <h5 class="card-title text-center">Register</h5>
              <form class="form-signin" action="register.php" method="post">
                <?php include('errors.php'); ?>
                <!-- <div class="form-label-group">
                  <input type="text" id="firstName" class="form-control" placeholder="First Name" required autofocus>
                  <label for="firstName">First Name</label>                  
                </div>
                <div class="form-label-group">
                  <input type="text" id="lastName" class="form-control" placeholder="Last Name" required>
                  <label for="lastName">Last Name</label>
                </div> -->
                <div class="form-label-group">
                  <input class="form-control" placeholder="First Name" type="text" name="firstName" value="<?php echo $firstName; ?>" id ="firstName">
                  <label for="firstName">First Name</label>                  
                </div>
                <div class="form-label-group">
                  <input class="form-control" placeholder="Last Name" type="text" name="lastName" value="<?php echo $lastName; ?>" id ="lastName">
                  <label for="lastName">Last Name</label>                  
                </div>
                <hr class="my-4"> 
                <div class="form-label-group">
                  <input class="form-control" placeholder="Username" type="text" name="username" value="<?php echo $username; ?>" id ="username">
                  <label for="username">Username</label>                  
                </div>
                <div class="form-label-group">
                  <input class="form-control" placeholder="Email address" type="text" name="email" value="<?php echo $email; ?>" id="email">
                  <label for="email">Email address</label>                  
                </div>

                <div class="form-label-group">
                  <input type="password" id="password" name="password_1" class="form-control" placeholder="Password" value="<?php echo $password; ?>" required>
                  <label for="password">Password</label>
                  <!-- <span class="help-block"><?php echo $password_err; ?></span> -->
                </div>

                <div class="form-label-group">
                  <input type="password" id="confirm_password" name="password_2" class="form-control" placeholder="Password" required>
                  <label for="confirm_password">Confirm Password</label>
                  <!-- <span class="help-block"><?php echo $confirm_password_err; ?></span> -->
                </div>

                <!-- <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Remember password</label>
                </div> -->
                <hr class="my-4">
                <!-- <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Register</button> -->
                <!-- <button class="btn btn-lg btn-default btn-block text-uppercase" type="reset">Reset</button> -->
               <!--  <div class="input-group">
                  <button type="submit" class="btn" name="reg_user">Register</button>
                </div> -->

                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="reg_user">Register</button>
                <button class="btn btn-lg btn-default btn-block text-uppercase" type="reset">Reset</button>

                <hr class="my-4">


                <p align="center">
                  Already a member? <a href="login.php">Sign in</a>
                </p>
                
               <!--  <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
                <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>