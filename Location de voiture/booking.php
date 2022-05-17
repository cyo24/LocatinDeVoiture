<!DOCTYPE html>
<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?> 
<title>Ouriemi Location </title>
<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>  
  <script type="text/javascript" src="assets/js/custom.js"></script> 
 <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body ng-app=""> 


      <!-- Navigation -->
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
                        <a href="index.php">Accueil</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Bienvenu <?php echo $_SESSION['login_client']; ?></a>
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
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garage <span class="caret"></span> </a>
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
    
<div class="container" style="margin-top: 65px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form" action="bookingconfirm.php" method="POST">
        <br style="clear: both">
          <br>

        <?php
        $car_id = $_GET["id"];
        $sql1 = "SELECT * FROM cars WHERE car_id = '$car_id'";
        $result1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result1)){
            while($row1 = mysqli_fetch_assoc($result1)){
                $car_name = $row1["car_name"];
                $car_nameplate = $row1["car_nameplate"];
               
                $non_ac_price = $row1["non_ac_price"];
                
                
            }
        }

        ?>

          <!-- <div class="form-group"> -->
              <h5> Voiture sélectionnée:&nbsp;  <b><?php echo($car_name);?></b></h5>
         <!-- </div> -->
         
          <!-- <div class="form-group"> -->
            <h5> Immatriculation:&nbsp;<b> <?php echo($car_nameplate);?></b></h5>
          <!-- </div>      -->
        <!-- <div class="form-group"> -->
        <?php $today = date("Y-m-d") ?>
          <label><h5>Date début:</h5></label>
            <input type="date" name="rent_start_date" min="<?php echo($today);?>" required="">
            &nbsp; <br>
          <label><h5>Date fin:</h5></label>
          <input type="date" name="rent_end_date" min="<?php echo($today);?>" required="">
        <!-- </div>      -->
        
        
                
        
        <div ng-switch="myVar"> 
        <div ng-switch-default>
                    <!-- <div class="form-group"> -->
                <h5>Tarif: <b><?php echo( $non_ac_price . "DT/jour");?></b><h5>    
                     </div>
                    
        </div>



            <br><br>
                
                <input type="hidden" name="hidden_carid" value="<?php echo $car_id; ?>">
                
         
           <input type="submit"name="submit" value="Valider" class="btn btn-warning pull-right">     
        </form>
        
      </div>
      <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6><strong>Note:</strong> Un supplément vous sera facturé <span class="text-danger">100 DT</span> pour chaque jour après la fin de la date d'échéance.</h6>
        </div>
    </div>

</body>
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