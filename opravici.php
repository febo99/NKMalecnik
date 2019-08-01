<?php
include "login/config.php";
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $datumOd = mysqli_real_escape_string($db,$_POST['datumOd']);
     $datumDo = mysqli_real_escape_string($db,$_POST['datumDo']);
	 $razlog = mysqli_real_escape_string($db,$_POST['razlog']);
	 $ekipaID = mysqli_real_escape_string($db,$_POST['ekipa']);
	 $igralec = mysqli_real_escape_string($db,$_POST['igralec']);
     $id = $_SESSION['id'];
    $sql = "INSERT INTO opraviceniIgralci(igralecID,ekipaID,datumOd,datumDo,razlog,dodal) VALUES ('$igralec','$ekipaID','$datumOd','$datumDo','$razlog','$id')";
     mysqli_query($db,$sql);
     header("location:Vsi_igralci/Vsi_igralci.php");
   }
