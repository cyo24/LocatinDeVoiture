<?php
session_start(); 
require '../../connection.php';
$conn = Connect();

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM cars WHERE car_id='$id'";
	$query = $conn->query($sql);
    if($query)
    {
        header("Location:voitures.php");
    }
    else
    {
        echo '<script> alert("Voiture non supprimée"); </script>';
    }
}

?>