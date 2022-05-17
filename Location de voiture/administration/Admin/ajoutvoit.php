<?php
session_start(); 
require '../../connection.php';
$conn = Connect();

function GetImageExtension($imagetype) {
    if(empty($imagetype)) return false;
    
    switch($imagetype) {
        case '../../assets/img/cars/bmp': return '.bmp';
        case '../../assets/img/cars/gif': return '.gif';
        case '../../assets/img/cars/jpeg': return '.jpg';
        case '../../assets/img/cars/png': return '.png';
        default: return false;
    }
}

$car_name = $_POST['car_name'];
$car_nameplate = $_POST['car_nameplate'];
$non_ac_price =$_POST['non_ac_price'];
$car_availability = "oui";

//$query = "INSERT into cars(car_name,car_nameplate,ac_price,non_ac_price,car_availability) VALUES('" . $car_name . "','" . $car_nameplate . "','" . $ac_price . "','" . $non_ac_price . "','" . $car_availability ."')";
//$success = $conn->query($query);


if (!empty($_FILES["uploadedimage"]["name"])) {
    $file_name=$_FILES["uploadedimage"]["name"];
    $temp_name=$_FILES["uploadedimage"]["tmp_name"];
    $imgtype=$_FILES["uploadedimage"]["type"];
    $ext= GetImageExtension($imgtype);
	echo $ext;
    $imagename=$_FILES["uploadedimage"]["name"];
    $target_path = "assets/img/cars/".$imagename;

    if(move_uploaded_file($temp_name, $target_path)) {


        $query = "INSERT into cars(car_name,car_nameplate,car_img,non_ac_price,car_availability) VALUES('" . $car_name . "','" . $car_nameplate . "','".$target_path. "','" . $non_ac_price . "','"  . $car_availability ."')";
        $success = $conn->query($query);

	}

if (!$success){ 
 echo $conn->error; 
        echo "<br><br>
        echo <a href='ajoutvoiture.php' class='btn btn-default'> Revenir </a>
</div>;";	
}
else {
    header("location: voitures.php"); //Redirecting 
}
}
$conn->close();

?>