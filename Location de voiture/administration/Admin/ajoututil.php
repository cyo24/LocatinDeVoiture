<?php
session_start(); 
require '../../connection.php';
$conn = Connect();

$nomu = $_POST['fname'];
$mdp = $_POST['lname'];
$nom =$_POST['contact'];
$pren =$_POST['course'];;



        $query = "INSERT into admin(username,password,firstname,lastname) VALUES('" . $nomu . "','" . $mdp . "','".$nom. "','" . $pren ."')";
        $success = $conn->query($query);



if (!$success){ 
 echo $conn->error; 
        echo "<br><br>
        echo <a href='utlisateurs.php' class='btn btn-default'> Revenir </a>
</div>;";	
}
else {
    header("location: utlisateurs.php"); //Redirecting 
}

$conn->close();

?>