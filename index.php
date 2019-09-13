<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	//header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
  }
?>

<html>
	<head>
		
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	    <title>Welcome to Sci-Tings!</title>
	    <?php readfile("dependencies.html"); ?>
	</head>

	<style type="text/css">
		html, body {
		  height: 100%;
		  margin: 0;
		  padding: 0;
		}
		#container { /* div you want to stretch */
		  background-color: #e9ecef;
		  height: 100%; /** IE 6 */
		  min-height: 100%;
		}
		
	</style>	

	<body>
		<div id="container">
			<?php include("navbar.php"); ?>

			<div class="content">
  				<!-- notification message -->
			  	<?php if (isset($_SESSION['success'])) : ?>
			      <div class="error success" >
			      	<h3>
			          <?php 
			          	echo $_SESSION['success']; 
			          	unset($_SESSION['success']);
			          ?>
			      	</h3>
			      </div>
			  	<?php endif ?>

			    
			</div>
			<div class="jumbotron">
				<h1 class="display-4" align="center">Hello World! </h1>
			  	<p class="lead" align="center">Welcome to Sci-Tings, home to the world's largest open-source data analysis portal!</p>
			  	<hr class="my-4">
			  	<div class="container">
				 	<div class="row justify-content-center">
				 		<div class="card">
			  				<div class="card-header">Welcome to Sci-Tings</div>
							<div class="card-body">
								<h5 class="card-title">Start exploring all the Data</h5>
					    		<p class="card-text">All of this data is yours and everyones.</p>
					    		<a href="explore.php" class="btn btn-primary">Go somewhere</a>
							</div>
						</div>
					</div>
					<br>
					<div class="row justify-content-center">
						<div class="card text-white bg-dark" style="max-width: 20rem;">
			  				<div class="card-header">Have FUN!</div>
				  			<div class="card-body">
				    			<h5 class="card-title">Lots and lots of FUN!</h5>
				    			<p class="card-text text-white">......but not too much fun.</p>
			  				</div>
						</div>
					</div>
				</div>		
			</div>
		</div>	
	</body>
</html>