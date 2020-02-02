<?php  
include 'connection.php';
session_start();

if(!isset($_SESSION["username"]))
{
    // not logged in
    header('Location: login.php');
    exit();
}

$category_option = "SELECT `idCategory`, `category` FROM`categories`";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Transactions</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom Fonts from Google -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		function do_submit(){
			var amount=document.getElementById('amount').value;
			var date=document.getElementById('date').value;
			var category=document.getElementById('category').value;
			var paymentMethod=document.getElementById('paymentMethod').value;
			{
				$.ajax({
					type:'POST',
					url:'post.php',
					data:{
					   	do_submit:"do_submit",
					   	amount:amount,
					   	date:date,
					   	category:category,
					   	paymentMethod:paymentMethod
					},
					success:function(response) {
						if(response == "success")
						{
						    document.getElementById("submit-succ").style.display = "block";
						    document.getElementById("submit-fail").style.display = "none";
						    $("#form-tran")[0].reset();							
						}
						else
						{
						    document.getElementById("submit-fail").style.display = "block";
						    document.getElementById("submit-succ").style.display = "none";
						}
					}
				});
			}			
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
                    <li>
                        <a href="home.php">Home</a>
                    </li>
					<li class="dropdown active">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="about-us">
							<li class="active"><a href="#">Add Transaction</a></li>
							<li><a href="monitor.php">Monitor</a></li>
						</ul>
					</li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

	<div id="transact" class="loginbox">
		<h2 id="tran-h2">Add your Transactions</h2>
		<form id="form-tran" action="/">
			<img src="FrontElemen/icongreat-white.png" alt="icon" class="icon">
			<input type="number" name="amount" id="amount" placeholder="Transaction amount" required>
			<br>
			<img src="FrontElemen/icongreat-white.png" alt="icon" class="icon">
			<input type="date" name="date" id="date" value="<?php echo date("Y-m-d") ?>" required>
			<br>
			<img src="FrontElemen/icongreat-white.png" alt="icon" class="icon">
			<select name="category" id="category" class="options" required>
				<option selected="selected" disabled="">Category</option>
				<?php 
					$query_category = "SELECT * FROM categories";
					$result_categories = $link->query($query_category);
					while($var = $result_categories->fetch_assoc()){
						echo '<option value = "'.$var['idCategory'].'">'.ucfirst($var['category']).'</option>';
					}
				?>
			</select>
			<br>
			<img src="FrontElemen/icongreat-white.png" alt="icon" class="icon">
			<select name="paymentMethod" id="paymentMethod" class="options" required>
				<option selected="selected" disabled="">Payment Method</option>
				<?php 
					$query_payment = "SELECT * FROM payments";
					$result_payment = $link->query($query_payment);
					while ($var = $result_payment->fetch_assoc()) {
					    echo '<option value="' . $var['idPayment'] . '">' .ucfirst($var['paymentMethod']) . '</option>';
					} 
				?>
			</select>
			<br>
			<input type="submit" name="submit-tran" value="Submit" onclick="do_submit()">
		</form>
		<!-- <div class="success" id="error_code" style="display:block;"> -->
		<div class="success" id="submit-succ" style="display: none;">Added Successfully</div>
		<div class="fail" id="submit-fail" style="display: none;">Please try again</div>
		<!-- </div>	 -->
		<script>
            /* attach a submit handler to the form */
            $("#form-tran").submit(function(event) {
                /* stop form from submitting normally */
                event.preventDefault();
            });
        </script>
	</div>
	

    <!-- jQuery -->
    <script src="js/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    
    <!-- Custom Javascript -->
    <script src="js/custom.js"></script>	

</body>
</html>