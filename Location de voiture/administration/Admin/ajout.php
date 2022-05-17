<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moez";
$conn = new mysqli($servername, $username, $password, $dbname);
$t =$_POST['tit'];
$p =$_POST['pres'];
$d =$_POST['det'];
$c =$_POST['cara'];
$s =$_POST['stat'];
$cnt =$_POST['cont'];
$pl=$_POST['pl'];
$sql = "INSERT INTO projetsenc (tit,pres,det,carac,cont,plan,statut) VALUES('$t','$p','$d','$c','$cnt','$pl','$s')";
 	$query = $conn->query($sql);
echo "Ajout effectué avec succées";
           header('Location: projets.php');


?>