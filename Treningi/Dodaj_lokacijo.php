<?php
include "../login/config.php";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $ime = mysqli_real_escape_string($db,$_POST['lokacija']);
     $barva = "hsl(".rand(0,361).",50%,75%)";
     $sql = "INSERT INTO lokacije(ime,barva) VALUES ('$ime','$barva')";
     $result = mysqli_query($db,$sql);
     header("location:Lokacije.php");
  }
?>
