<?php
include "login/config.php";
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	   $avtorID = $_SESSION['id'];
	 $id = mysqli_real_escape_string($db,$_POST['idKomentarja']);

     $komentar = mysqli_real_escape_string($db,$_POST['komentar'.$id]);
     if(empty($komentar) || $komentar == "")header("location:dashboard.php");
     else{
     $ura = date("Y-m-d H:i:s");
       $sql = "INSERT INTO komentarji(objavaID,avtorID,datumCas,komentar) VALUES ('$id','$avtorID','$ura','$komentar')";
       $result = mysqli_query($db,$sql);
	   header("location:dashboard.php");
    }
  }

?>