<?php
include "../login/config.php";
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     foreach ($_POST as $param_name => $param_val) {
       $igralecID = (int)substr($param_name,10,1);
       $prisotnost = (int)$param_val;
       $treningID = $_POST['treningID'];
       $sql = "UPDATE prisotnost SET `prisotnost` = '$prisotnost' WHERE `igralecID` = '$igralecID' AND `treningID` = '$treningID'";
       $sqltrening = "UPDATE treningi SET `prisotnost` = 1 WHERE `ID` = '$treningID'";
       mysqli_query($db,$sql);
       mysqli_query($db,$sqltrening);

  }
  header("location:Moji_treningi.php");
}
