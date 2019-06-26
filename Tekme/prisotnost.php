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
       $tekmaID = $_POST['treningID'];
       $prisotnostT = mysqli_fetch_assoc(mysqli_query($db,"SELECT prisotnost FROM tekme WHERE `ID` = '$tekmaID'"));
       $sql = "UPDATE prisotnostTekme SET `prisotnost` = '$prisotnost' WHERE `igralecID` = '$igralecID' AND `tekmaID` = '$tekmaID'";
       $sqltrening = "UPDATE tekme SET `prisotnost` = 1 WHERE `ID` = '$tekmaID'";
       mysqli_query($db,$sql);
       mysqli_query($db,$sqltrening);
      
  }
  if($prisotnostT['prisotnost'] == 0)header("location:Moje_tekme.php");
  else header("location:Tekma.php?id=".$tekmaID);
}
