<?php
include "../login/config.php";
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     foreach ($_POST as $param_name => $param_val) {
       $igralecID = (int)substr($param_name,10,1);
       $prisotnost = (int)$param_val;
       $tekmaID = $_POST['treningID'];
       $sql = "UPDATE prisotnostTekme SET `prisotnost` = '$prisotnost' WHERE `igralecID` = '$igralecID' AND `tekmaID` = '$tekmaID'";
       $sqltrening = "UPDATE tekme SET `prisotnost` = 1 WHERE `ID` = '$tekmaID'";
       mysqli_query($db,$sql);
       mysqli_query($db,$sqltrening);

  }
  header("location:Moje_tekme.php");
}
