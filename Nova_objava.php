<?php
include "login/config.php";
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $objava = mysqli_real_escape_string($db,$_POST['objava']);
     if(empty($objava) || $objava == "")header("location:dashboard.php");
     else{
     $ura = date("Y-m-d H:i:s");
     $id = $_SESSION['id'];
       $sql = "INSERT INTO objave(avtorID,datumCas,obvestilo) VALUES ('$id','$ura','$objava')";
       $result = mysqli_query($db,$sql);
     header("location:dashboard.php");
    }
  }

?>