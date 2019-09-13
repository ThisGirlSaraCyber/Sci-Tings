<?php require('server.php') ?>

<?php 

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'active';
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top">			
	<div class="container-fluid">
		
  		<div class="navbar-header">
    		<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      			<span class="navbar-toggler-icon"></span>

	        </button>
    		
  		</div>

		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item" ><a class="nav-link" style="color:#4CAF50;"><b>Sci-Tings</b></a></li>
		    	<li class="nav-item <?=echoActiveClassIfRequestMatches("index")?>">
		        	<a class="nav-link" href="index.php">Home </a>
		      	</li>
		      	<li class="nav-item <?=echoActiveClassIfRequestMatches("explore")?>" >
		        	<a class="nav-link" href="explore.php">Explore Data!</a>
		      	</li>
		      	<li class="nav-item dropdown">
		        	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          		Discussions
		        	</a>
		        	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          		<a class="dropdown-item" href="#">Climate Data</a>
		          		<a class="dropdown-item" href="#">Healthcare Data</a>
		          		<div class="dropdown-divider"></div>
		          		<a class="dropdown-item" href="#">Data Repository</a>
		        	</div>
		      	</li>					      	
		    </ul>
		    <form class="form-inline my-2 my-lg-0">
		    	<input class="form-control mr-sm-2" type="search" placeholder="Search Data!" aria-label="Search" size="90">
		    	<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		    </form>
		    <ul class="navbar-nav ml-auto">
		    	<!-- logged in user information -->
    			<?php  if (isset($_SESSION['username'])) : ?>
    				<li class="nav-item active">
    					<a class="nav-link" href="home.php">Welcome <strong><?php echo $_SESSION['username']; ?></strong>!</a>
    				</li>
    				<li class="nav-item">
    					<a class="nav-link" href="index.php?logout='1'">Logout</a>
    				</li>
    			<?php else : ?>
		      	<li class="nav-item <?=echoActiveClassIfRequestMatches("register")?>">
			        <a class="nav-link" href="register.php">Register</a>
		    	</li>
		    	<li class="nav-item <?=echoActiveClassIfRequestMatches("login")?>">
			        <a class="nav-link" href="login.php">Login</a>
		    	</li>
		    	<?php endif ?>
		    </ul>
		 </div>	
	</div>
</nav>