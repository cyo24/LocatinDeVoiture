<?php 
session_start(); 
require '../../connection.php';
$conn = Connect();
?>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin - Panel</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
<style>
input[type=text], select,textarea,file {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  background-color: #f8f8f8;
}

input[type=submit] {
  width: 30%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.div2 {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
  </head>

  <body id="page-top">
<!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Suppresion d'une location </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="supploc.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Voulez vous vraiment supprimer cet enregistrement ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Oui !! Supprimer. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.html">Administration</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
 

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
       
   
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
       
          </a>

        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Parametres</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Accueil</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
              <span>Voitures</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
		   <a class="dropdown-item" href="ajoutvoiture.php">Ajouter</a>
		   <a class="dropdown-item" href="voitures.php">Voir tous</a>

            
            
          </div>
            
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="clients.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Clients</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-table"></i>
            <span>Locations</span></a>
        </li>
		 <li class="nav-item">
          <a class="nav-link" href="utlisateurs.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Utilisateurs</span></a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
             Liste locations</div>

          </div>
<div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
				<th>Num location</th>
                  <th>Nom client</th>
                  <th>Num voiture</th>
                  <th>Date réservation</th>
                  <th>Date début Loc</th>
				  <th>Date fin Loc</th>
				  <th>Date retour voit</th>
				  <th>Tarif</th>
				  <th>Nbre de jour</th>
				  <th>Total</th>
				  <th>Status</th>
				  <th>Outils</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM rentedcars";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
						<td>".$row['id']."</td>
                          <td>".$row['customer_username']."</td>
                          <td>".$row['car_id']."</td>
						  <td>".$row['booking_date']."</td>
						  <td>".$row['rent_start_date']."</td>
						  <td>".$row['rent_end_date']."</td>
						  <td>".$row['car_return_date']."</td>
						<td>".$row['fare']."</td>
						<td>".$row['no_of_days']."</td>
						<td>".$row['total_amount']."</td>
						<td>".$row['return_status']."</td>
						  
                          
                          <td>
                            <button class='btn btn-danger deletebtn' data-id='".$row['id']."'><i class='fa fa-trash'></i> Supprimer</button>
                          </td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
 

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment vous deconnecter?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Selectionnez "Deconnexion" si vous voulez terminer votre session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
            <a class="btn btn-primary" href="login.html">Deconnexion</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>



    <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>


  </body>

</html>
