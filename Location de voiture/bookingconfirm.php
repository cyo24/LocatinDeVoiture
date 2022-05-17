<!DOCTYPE html>
<html>

<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
</head>

<body>

<?php


    $customer_username = $_SESSION["login_customer"];
    $car_id = $conn->real_escape_string($_POST['hidden_carid']);
    $rent_start_date = date('Y-m-d', strtotime($_POST['rent_start_date']));
    $rent_end_date = date('Y-m-d', strtotime($_POST['rent_end_date']));
	
    $return_status = "NR"; // not returned
    $fare = "NA";


    function dateDiff($start, $end) {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }
    
    $err_date = dateDiff("$rent_start_date", "$rent_end_date");

    $sql0 = "SELECT * FROM cars WHERE car_id = '$car_id'";
    $result0 = $conn->query($sql0);

    if (mysqli_num_rows($result0) > 0) {
        while($row0 = mysqli_fetch_assoc($result0)) {

            $car_name=$row0["car_name"];
			$car_nameplate=$row0["car_nameplate"];
            $fare = $row0["non_ac_price"];
            $mnt=$fare*$err_date;
        }
    }
	$sqlc = "SELECT * FROM customers WHERE customer_username = '$customer_username'";
    $resultc = $conn->query($sqlc);
	 if (mysqli_num_rows($result0) > 0) {
        while($rowc = mysqli_fetch_assoc($result0)) {

            $nomcl=$rowc["customer_name"];
			$tel=$rowc["customer_phone"];
			$adresse=$rowc["customer_addres"];
		
        }
    }
    if($err_date >= 0) { 
    $sql1 = "INSERT into rentedcars(customer_username,car_id,booking_date,rent_start_date,rent_end_date,fare,no_of_days,return_status) 
    VALUES('" . $customer_username . "','" . $car_id . "','" .  date("Y-m-d") ."','" . $rent_start_date ."','" . $rent_end_date . "','" . $fare . "','" .$err_date.  "','" . $return_status . "')";
    $result1 = $conn->query($sql1);
	echo mysqli_error($conn);

    $sql2 = "UPDATE cars SET car_availability = 'non' WHERE car_id = '$car_id'";
    $result2 = $conn->query($sql2);

    

    $sql4 = "SELECT * FROM  cars c, customers cr,  rentedcars rc WHERE c.car_id = '$car_id'  AND rc.customer_username = '$customer_username'";
    $result4 = $conn->query($sql4);


    if (mysqli_num_rows($result4) > 0) {
        while($row = mysqli_fetch_assoc($result4)) {
            $id = $row["id"];
            $car_name = $row["car_name"];
            $car_nameplate = $row["car_nameplate"];
            $client_name = $row["customer_username"];
            $client_phone = $row["customer_phone"];
        }
    }

    if (!$result1 | !$result2){
        die("Couldnt enter data: ".$conn->error);
    }

?>
<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   Ouriemi Location </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if(isset($_SESSION['login_client'])){
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                    <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="entercar.php">Add Car</a></li>
              <li> <a href="enterdriver.php"> Add Driver</a></li>
              <li> <a href="clientview.php">View</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>
            
            <?php
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Accueil</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Bienvenu <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garagge <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturncar.php">Retourner</a></li>
              <li> <a href="mybookings.php"> Historique</a></li>
            </ul>
            </li>
          </ul>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a>
                    </li>
                </ul>
            </div>

            <?php
            }
                else {
            ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="clientlogin.php">Employee</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Customer</a>
                    </li>
                    <li>
                        <a href="#"> FAQ </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Réservation confirmée.</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> Merci d'utiliser le système de location de voitures ! Nous vous souhaitons un bon voyage. </h2>

 

    <h3 class="text-center"> <strong>Votre numéro de commande:</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>


    <div class="container">
        <h5 class="text-center">Veuillez lire les informations suivantes concernant votre commande.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: orange;">Votre réservation a été reçue et placée dans notre système de traitement des commandes.</h3>
                <br>
                <h4>Veuillez noter votre <strong>numéro de commande</strong> maintenant et conservez-le au cas où vous auriez besoin de communiquer avec nous au sujet de votre commande.</h4>
                <br>
                <h3 style="color: orange;">Facture</h3>
                <br>
            </div>
			<?php
			$sqlc = "SELECT * FROM customers WHERE customer_username = '$customer_username'";
    $resultc = $conn->query($sqlc);
	 
        while($rowc = mysqli_fetch_assoc($resultc)) {

            $nomcl=$rowc["customer_name"];
			$tel=$rowc["customer_phone"];
			$adresse=$rowc["customer_address"];
		
        }
    
	?>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
			 <h4> <strong>Facture au nom de  : </strong> <?php echo $nomcl; ?></h4>
			 <h4> <strong>Adresse  : </strong> <?php echo $adresse; ?></h4>
			 <h4> <strong>Télphone  : </strong> <?php echo $tel; ?></h4>
			 <hr>
                <h4> <strong>Nom de la voiture : </strong> <?php echo $car_name; ?></h4>
                <br>
                <h4> <strong>Immatriculation:</strong> <?php echo $car_nameplate; ?></h4>
                <br>
                
               
                     <h4> <strong>Tarif:</strong>  <?php echo $fare; ?>DT/jour</h4>
					 <h4> <strong>Montant Total:</strong>  <?php echo $mnt; ?>DT</h4>



                <br>
                <h4> <strong>Date réservation: </strong> <?php echo date("Y-m-d"); ?> </h4>
                <br>
                <h4> <strong>Date début: </strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4> <strong>Date retour: </strong> <?php echo $rent_end_date; ?></h4>

            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6>Avertissement! <strong>Ne rechargez pas cette page</strong> ou l'affichage ci-dessus sera perdu. Si vous souhaitez une copie papier de cette page, veuillez l'imprimer maintenant.</h6>
        </div>
    </div>
</body>
<?php } else { ?>
    <!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   Car Rentals </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
                if(isset($_SESSION['login_client'])){
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                    <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="entercar.php">Add Car</a></li>
              <li> <a href="enterdriver.php"> Add Driver</a></li>
              <li> <a href="clientview.php">View</a></li>

            </ul>
            </li>
          </ul>
                    </li>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>
            
            <?php
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garagge <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturncar.php">Return Now</a></li>
              <li> <a href="mybookings.php"> My Bookings</a></li>
            </ul>
            </li>
          </ul>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>

            <?php
            }
                else {
            ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="clientlogin.php">Employee</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Customer</a>
                    </li>
                    <li>
                        <a href="#"> FAQ </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">
	<div class="jumbotron" style="text-align: center;">
        You have selected an incorrect date.
        <br><br>
</div>
                <?php } ?>
<footer class="site-footer">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <h5>© <?php echo date("Y"); ?> Ouriemi Location</h5>
            </div>
        </div>
    </div>
</footer>

</html>