<?php
include "../login/config.php";
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     foreach ($_POST as $param_name => $param_val) {
       $clanID = (int)substr($param_name,10,1);
       $prisotnost = (int)$param_val;
       $akcijaID = $_POST['treningID'];
       $redir  = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM delovneAkcije WHERE `ID` = '$akcijaID'"));
       
       $sql = "UPDATE prisotnostAkcije SET `prisotnost` = '$prisotnost' WHERE `clanID` = '$clanID' AND `akcijaID` = '$akcijaID'";
       $sqltrening = "UPDATE delovneAkcije SET `prisotnostT` = 1 WHERE `ID` = '$akcijaID'";
       mysqli_query($db,$sql);
       mysqli_query($db,$sqltrening);

  }
  if($redir['prisotnostT'] == 0) header("location:Delovne_akcije.php");
  else header("location:Akcija.php?id=".$akcijaID);
}
