<?php
session_start();
include "../login/config.php";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $ime = mysqli_real_escape_string($db,$_POST['lokacija']);
	 $id = mysqli_real_escape_string($db,$_POST['id']);
     $sql = "UPDATE lokacije SET `ime` = '$ime' WHERE `ID` = '$id'";
     $result = mysqli_query($db,$sql);
     header("location:Lokacije.php");    
}
?>