<?php
include "../login/config.php";
session_start();
$prvi = true;
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     foreach ($_POST as $param_name => $param_val) {
       if($prvi == true){
         $prvi = false;
         continue;
       }
       $igralecID = (int)substr($param_name,10,10);
       $prisotnost = (int)$param_val;
       $treningID = $_POST['treningID'];
       $sql = "UPDATE prisotnost SET `prisotnost` = '$prisotnost' WHERE `igralecID` = '$igralecID' AND `treningID` = '$treningID'";
       $prisotnostT = mysqli_fetch_assoc(mysqli_query($db,"SELECT prisotnost FROM treningi WHERE `ID` = '$treningID'"));
       $sqltrening = "UPDATE treningi SET `prisotnost` = 1 WHERE `ID` = '$treningID'";
       mysqli_query($db,$sql);
       mysqli_query($db,$sqltrening);

  }
  
  if($prisotnostT['prisotnost'] == 0)header("location:Moji_treningi.php");
  else header("location:Trening.php?id=".$treningID);
}
