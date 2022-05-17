<?php
session_start();
if(isset($_POST['userName']) && isset($_POST['passWord']))
{
    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'carrentalp';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = $_POST['userName']; 
    $password = $_POST['passWord'];
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM admin where 
              username = '".$username."' and password = '".$password."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           
           header('Location: admin/index.php');
        }
        else
        {
           header('Location: index.html'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: index.html'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: index.html');
}
mysqli_close($db); // fermer la connexion
?>