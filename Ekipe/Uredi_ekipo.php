<?php
include "../login/config.php";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $ime = mysqli_real_escape_string($db,$_POST['imeEkipe']);
     $trener = mysqli_real_escape_string($db,$_POST['trener']);
     $pom1 = mysqli_real_escape_string($db,$_POST['pomocnik1']);
     $pom2 = mysqli_real_escape_string($db,$_POST['pomocnik2']);
     $idEkipe = mysqli_real_escape_string($db,$_POST['idEkipe']);
     $sql = "UPDATE ekipe SET `imeEkipe` = '$ime',`trenerID` = '$trener',`pomocnik1ID` = '$pom1',`pomocnik2ID` = '$pom2' WHERE `ID` = '$idEkipe'";
    mysqli_query($db,$sql);
     header("location:Ekipe.php");    
   }
?>
