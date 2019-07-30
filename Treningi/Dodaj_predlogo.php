<?php
include "../login/config.php";
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $naslov = mysqli_real_escape_string($db,$_POST['naslov']);
     $uvod = mysqli_real_escape_string($db,$_POST['uvod']);
     $glavni = mysqli_real_escape_string($db,$_POST['glavni']);
     $zakljucni = mysqli_real_escape_string($db,$_POST['zakljucni']);
	 $sql = "INSERT INTO predlogeTreningov(naslov,uvod,glavni,zakljucek) VALUES ('$naslov','$uvod','$glavni','$zakljucni')";
	 $result = mysqli_query($db,$sql);
     header("location:Nova_predloga.php");
  }
?>
