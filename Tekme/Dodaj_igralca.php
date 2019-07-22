<?php
include "../login/config.php";
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {
    $d = "";
    $idTekme = $_POST['tekmaID'];
    foreach($_POST['igralci'] as $sel){
        $sqlT = "INSERT INTO prisotnostTekme(tekmaID,igralecID) VALUES ('$idTekme','$sel')";
        mysqli_query($db,$sqlT);
    }
   }

?>