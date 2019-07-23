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

       if(strpos($param_name, 'prisotnost') !== false){
        $igralecID = (int)substr($param_name,10,10);
        echo("<script>console.log('Prisotnost: ".$igralecID."');</script>");
        $tekmaID = $_POST['treningID'];
        $prisotnost = (int)$param_val;
        $prisotnostT = mysqli_fetch_assoc(mysqli_query($db,"SELECT prisotnost FROM tekme WHERE `ID` = '$tekmaID'"));
        $sql = "UPDATE prisotnostTekme SET `prisotnost` = '$prisotnost' WHERE `igralecID` = '$igralecID' AND `tekmaID` = '$tekmaID'";
        $sqltrening = "UPDATE tekme SET `prisotnost` = 1 WHERE `ID` = '$tekmaID'";
        mysqli_query($db,$sql);
        mysqli_query($db,$sqltrening);
        }
        else if(strpos($param_name, 'minute') !== false){
          $igralecID = (int)substr($param_name,6,6);
          echo("<script>console.log('PHP: ".$igralecID."');</script>");
          $tekmaID = $_POST['treningID'];
          $minute = (int)$param_val;
          $sql = "UPDATE prisotnostTekme SET `minute` = '$minute' WHERE `igralecID` = '$igralecID' AND `tekmaID` = '$tekmaID'";
          mysqli_query($db,$sql);
        }
        else if(strpos($param_name, 'goli') !== false){
          $igralecID = (int)substr($param_name,4,4);
          $tekmaID = $_POST['treningID'];
          $goli = (int)$param_val;
          $sql = "UPDATE prisotnostTekme SET `goli` = '$goli' WHERE `igralecID` = '$igralecID' AND `tekmaID` = '$tekmaID'";
          mysqli_query($db,$sql);
        }
        else if(strpos($param_name, 'kartoni') !== false){
          $igralecID = (int)substr($param_name,7,7);
          $tekmaID = $_POST['treningID'];
          $kartoni = $param_val;
          $sql = "UPDATE prisotnostTekme SET `kartoni` = '$kartoni' WHERE `igralecID` = '$igralecID' AND `tekmaID` = '$tekmaID'";
          mysqli_query($db,$sql);
        }
        else if(strpos($param_name, 'podaje') !== false){
          $igralecID = (int)substr($param_name,6,6);
          $tekmaID = $_POST['treningID'];
          $podaje = (int)$param_val;
          $sql = "UPDATE prisotnostTekme SET `podaje` = '$podaje' WHERE `igralecID` = '$igralecID' AND `tekmaID` = '$tekmaID'";
          mysqli_query($db,$sql);
        }
  }
    if($prisotnostT['prisotnost'] == 0)header("location:Moje_tekme.php");
    else header("location:Tekma.php?id=".$tekmaID);
}
