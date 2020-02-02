<?php  
session_start();

if(isset($_SESSION["username"]))
{
    //logged in
    header('Location: home.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Login</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom Fonts from Google -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=ABeeZee&display=swap" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    
    <!-- Custom Javascript -->
    <script src="js/custom.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		function do_login(){
			var username=document.getElementById('username').value;
			var password=document.getElementById('pwd').value;
			if(username!='' && password!='')
			{
				$.ajax({
					type:'POST',
					url:'login-code.php',
					data:{
					   	do_login:"do_login",
					   	username:username,
					   	password:password
					},
					success:function(response) {
						if(response == "success")
						{
							window.location.href="home.php";
						}
						else
						{
						    document.getElementById("error_code").style.display = "block";
						    document.getElementById("fill").style.display = "none";
						    document.getElementById("invalid").style.display = "block";
						}
					}
				});
			} 

			else
			{
			    document.getElementById("error_code").style.display = "block";
			    document.getElementById("invalid").style.display = "none";
			    document.getElementById("fill").style.display = "block";				
			}
			
				return false;
		}
	</script>

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
                <a class="navbar-brand" href="home.php">
                	<span class="glyphicon glyphicon-fire"></span> 
                	OnyX
                </a>
            </div>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a href="home.php">Home</a>
                    </li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="about-us">
							<li><a href="#">Add Transaction</a></li>
							<li><a href="#">Monitor</a></li>
						</ul>
					</li>
                </ul>
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

	<div class="loginbox">
	<img src="FrontElemen/Logo_with_shadow.png" alt="logo" class="logo">
		<h2>Login</h2>
		<form id="form" action="/">
			<img src="FrontElemen/icongreat-white.png" alt="icon" class="icon">
			<input type="text" name="username" id="username" placeholder="Username">
			<br>
			<img src="FrontElemen/icongreat-white.png" alt="icon" class="icon">
			<input type="password" name="password" id="pwd" placeholder="Password">
			<br>
			<input type="submit" name="login" value="Login" onclick="do_login()">
		</form>
		<div class="error" id="error_code" style="display:none;">
			<div id="invalid" style="display: none;">Invalid Username or Password</div>
			<div id="fill" style="display: none;">Please Fill All The Details</div>
		</div>	
		<script>
            /* attach a submit handler to the form */
            $("#form").submit(function(event) {
                /* stop form from submitting normally */
                event.preventDefault();
            });
        </script>		
	</div>
	
</body>
</html>