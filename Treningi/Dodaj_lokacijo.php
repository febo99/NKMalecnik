<?php
include "../login/config.php";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $ime = mysqli_real_escape_string($db,$_POST['lokacija']);
     $sql = "INSERT INTO lokacije(ime) VALUES ('$ime')";
     $result = mysqli_query($db,$sql);
     header("location:Lokacije.php");
  }
?>
