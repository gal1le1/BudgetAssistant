<?php    
include 'connection.php';
include 'getdata.php';

if(!isset($_SESSION["username"]))
{
    // not logged in
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Monitor</title>

    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
    <script>
        $(document).ready(function(){
            $('#myTable').Tabledit({
                url: 'update.php',
                restoreButton: false,
                columns: {
                    identifier: [0, 'id'],                    
                    editable: [[1, 'amount'], [2, 'category', '{"1": "Transportation", "2": "Entertainment", "3": "Rent", "4": "Phone", "5": "Food", "6": "Restaurant", "7": "Cinema", "8": "Theater", "9": "Gas", "10": "Postage", "11": "Travel", "12": "Leisure", "13": "Salary", "14": "Scholarship", "15": "Pocket money"}'], [3, 'payment', '{"1": "Cash", "2": "Check", "3": "Bank card", "4": "Bank transfer"}'], [4, 'date']]
                }
            });
        });
    </script>

    <script src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );      
    </script>

    <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Payment', 'Number of times'],
          ['Cash',     <?php echo $paymentStat[1] ?>],
          ['Check',    <?php echo $paymentStat[2] ?>],
          ['Bank card', <?php echo $paymentStat[3] ?>],
          ['Bank transfer', <?php echo $paymentStat[4] ?>]
        ]);

        var options = {
          title: 'Payment methods',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Category', 'Amount AZN'],
          ['Transportation', <?php echo $categoryStat[1] ?>],
          ['Entertainment', <?php echo $categoryStat[2] ?>],
          ['Rent', <?php echo $categoryStat[3] ?>],
          ['Phone', <?php echo $categoryStat[4] ?>],
          ['Food', <?php echo $categoryStat[5] ?>],
          ['Restaurant', <?php echo $categoryStat[6] ?>],
          ['Cinema' , <?php echo $categoryStat[7] ?>],
          ['Theater', <?php echo $categoryStat[8] ?>],
          ['Gas', <?php echo $categoryStat[9] ?>],
          ['Postage', <?php echo $categoryStat[10] ?>],
          ['Travel', <?php echo $categoryStat[11] ?>],
          ['Leisure', <?php echo $categoryStat[12] ?>],
          ['Salary', <?php echo $categoryStat[13] ?>],
          ['Scholarship', <?php echo $categoryStat[14] ?>],
          ['Pocket money', <?php echo $categoryStat[15] ?>]
        ]);

        var options = {
          chart: {
            title: 'Transaction amount per category',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

    <!--------------------------------------------->

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <script src="jquery.tabledit.js"></script>
    <!-- Custom Fonts from Google -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body style="background-color: black;">
	
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
							<li><a href="transaction.php">Add Transaction</a></li>
							<li class="active"><a href="#">Monitor</a></li>
						</ul>
					</li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
                
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>


    <section class="content" style="padding-bottom: 0px; margin-top:35px;">
        <p id="goodbudget" class="success" style="display:none; font-size: 18px">Your balance is: <?php echo $user->balance; ?> AZN</p>
        <p id="badbudget" class="fail" style=" display: none; font-size: 18px">Your balance is: <?php echo $user->balance; ?> AZN</p>
    </section>

	
    <div class="container">
	  <section class="content" style="padding-top:0px;">
		<table class="table display" id="myTable" border="1px black" cellspacing="1"style="background-color: white;">
			<thead>
				<tr>
				<th>#</th>
				<th>Amount</th>
				<th>Category</th>
				<th>Payment Method</th>
				<th>Transaction Date</th>
			</tr>
			</thead>
			

			<?php  
            for ($i=0; $i <$user->row_count ; $i++) {
                $j = $i+1;
                echo "<tr><td>".$j."</td>";
                echo "<td>".$user->transactionAmount[$i]."</td>";
                echo "<td>".$user->category[$i]."</td>";
                echo "<td>".$user->payment[$i]."</td>";
                echo "<td>".$user->transactionDate[$i]."</td></tr>";                
            }
			?>

		</table>		
	  </section>
    </div>

    <div class="container">
        <section class="content" style="padding-top:0px;">
            <div id="piechart_3d" style=" margin-left:calc(50% - 600px) ;width: 1200px; height: 500px;"></div>
            <div id="columnchart_material" style="margin-top:5px; margin-left:calc(50% - 600px) ;width: 1200px; height: 550px;"></div>
        </section>
    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    
    <!-- Custom Javascript -->
    <script src="js/custom.js"></script>
    <script type="text/javascript">
        if (Number(<?php echo $user->balance?>) > 0) {
            document.getElementById("goodbudget").style.display = "";
            document.getElementById("badbudget").style.display = "none";            
        }
        else{
            document.getElementById("badbudget").style.display = "";
            document.getElementById("goodbudget").style.display = "none";
        }
    </script>    


</body>
</html>