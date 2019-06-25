<?php
include "../login/config.php";
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     foreach ($_POST as $param_name => $param_val) {
       $clanID = (int)substr($param_name,10,1);
       $prisotnost = (int)$param_val;
       $akcijaID = $_POST['treningID'];
       $sql = "UPDATE prisotnostAkcije SET `prisotnost` = '$prisotnost' WHERE `clanID` = '$clanID' AND `akcijaID` = '$akcijaID'";
       $sqltrening = "UPDATE delovneAkcije SET `prisotnost` = 1 WHERE `ID` = '$akcijaID'";
       mysqli_query($db,$sql);
       mysqli_query($db,$sqltrening);

  }
  header("location:Delovne_akcije.php");
}
