<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom Fonts from Google -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    
</head>

<body>

    <!-- Navigation -->
    <nav id="siteNav" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Logo and responsive toggle -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                	<span class="glyphicon glyphicon-fire"></span> 
                	OnyX
                </a>
            </div>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="#">Home</a>
                    </li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="about-us">
							<li><a href="transaction.php">Add Transaction</a></li>
							<li><a href="monitor.php">Monitor</a></li>
						</ul>
					</li>
                    <li>
                        <a href="#about-us">About us</a>
                    </li>
                    <li>
                        <a href="#contact-us">Contact</a>
                    </li>
                    <!-- <div id="logout-tab" style=""> -->
                    <li id="logout-tab" style="display: none;">
                        <a href="logout.php">Logout</a>
                    </li>
                    <!-- </div>                     -->
                </ul>
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

	<!-- Header -->
    <header>
        <div class="header-content">
            <div class="header-content-inner" id="home-login" style="display: none;">
                <h1 style="font-size:90px;">Let Us Do It For You</h1>
                <p>Expect nothing less than perfect</p>
                <a href="login.php" class="btn btn-primary btn-lg">Login</a>
            </div>
            <div class="header-content-inner" id="home-logout" style="display: none;">
                <h1 style="font-size:90px;">Welcome <?php echo $_SESSION["username"]; ?></h1>
                <p>Take a look at your transactions</p>
                <a href="monitor.php" class="btn btn-primary btn-lg">Monitor</a>
            </div>            
        </div>
    </header>

	<!-- Content 2 -->
     <section class="content content-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                	<h2 class="section-header">Superior Quality</h2>
                	<p class="lead text-light">Holisticly predominate extensible testing procedures for reliable supply chains. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
                	<a href="#" class="btn btn-default btn-lg">Test It</a>
                </div>    
                <div class="col-sm-6">
                    <img class="img-responsive img-circle center-block" src="images/iphone.jpg" alt="">
                </div>            
                
            </div>
        </div>
    </section>    

	<!-- Content 3 -->
     <section class="content content-3" id="about-us">
        <div class="container">
			<h2 class="section-header"><span class="glyphicon glyphicon-pushpin text-primary"></span><br>About Us</h2>
			<p class="lead text-muted">Holisticly predominate extensible testing procedures for reliable supply chains. Dynamically innovate resource-leveling customer service for state of the art customer service.</p> 
                    <a href="#contact-us" class="btn btn-primary btn-lg">Contact Now</a>               
            </div>
        </div>
    </section>
    
	<!-- Footer -->
    <footer class="page-footer">
    
    	<!-- Contact Us -->
        <div class="contact">
        	<div class="container">
				<h2 class="section-heading" id="contact-us">Contact Us</h2>
				<p><span class="glyphicon glyphicon-earphone"></span><br> Shirin Shukurov<br> +994(55) 707 8776</p>
				<p><span class="glyphicon glyphicon-envelope"></span><br> info@onyx.com</p>
        	</div>
        </div>
        	
        <!-- Copyright etc -->
        <div class="small-print">
        	<div class="container">
        		<p>Copyright &copy; Onyx.com 2019</p>
        	</div>
        </div>
        
    </footer>

    <!-- jQuery -->
    <script src="js/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    
    <!-- Custom Javascript -->
    <script src="js/custom.js"></script>

    <?php  
    if(isset($_SESSION["username"]))
    {
        echo "
            <script type=\"text/javascript\">
            document.getElementById('logout-tab').style.display = \"\";
            document.getElementById('home-logout').style.display = \"\";
            document.getElementById('home-login').style.display = \"none\";
            </script>
        ";
    }
    else
    {
        echo "
            <script type=\"text/javascript\">
            document.getElementById('logout-tab').style.display = \"none\";
            document.getElementById('home-login').style.display = \"\";
            document.getElementById('home-logout').style.display = \"none\";
            </script>
        ";        
    }

    ?>

</body>

</html>
