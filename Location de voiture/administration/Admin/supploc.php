<?php
session_start(); 
require '../../connection.php';
$conn = Connect();

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];

    $sql = "DELETE FROM rentedcars WHERE id='$id'";
	$query = $conn->query($sql);
    if($query)
    {
        header("Location:locations.php");
    }
    else
    {
        echo '<script> alert("Location non supprimée"); </script>';
    }
}

?>