<?php
include "../login/config.php";
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
       $id = $_SESSION['id'];
     $naslov = mysqli_real_escape_string($db,$_POST['naslov']);
     $porocilo = mysqli_real_escape_string($db,$_POST['porocilo']);
     $konec = mysqli_real_escape_string($db,$_POST['konec']);
     $zacetek = mysqli_real_escape_string($db,$_POST['zacetek']);
     $datum = mysqli_real_escape_string($db,$_POST['datum']);
     $id = mysqli_real_escape_string($db,$_POST['id']);
     $ure = round(abs(strtotime($konec) - strtotime($zacetek)) / 3600,2);
    $sql = "UPDATE delovneAkcije SET `naslov`='$naslov',`datum`='$datum',`zacetek`='$zacetek',`konec`='$konec',`porocilo`='$porocilo',`ure`='$ure' WHERE `ID` = '$id'";
     mysqli_query($db,$sql);
     header("location:Urejanje_akcije.php?id=".$id);
   }

?>