<?php
session_start(); 
require '../../connection.php';
$conn = Connect();

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM admin WHERE id='$id'";
	$query = $conn->query($sql);
    if($query)
    {
        header("Location:utlisateurs.php");
    }
    else
    {
        echo '<script> alert("Utlisateurs non supprimé!!!"); </script>';
    }
}

?>