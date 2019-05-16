<?php
include "../login/config.php";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $ime = mysqli_real_escape_string($db,$_POST['imeEkipe']);
     $trener = mysqli_real_escape_string($db,$_POST['trener']);
     $pom1 = mysqli_real_escape_string($db,$_POST['pomocnik1']);
     $pom2 = mysqli_real_escape_string($db,$_POST['pomocnik2']);
     $sql = "INSERT INTO ekipe(imeEkipe,trenerID,pomocnik1ID,pomocnik2ID) VALUES ('$ime','$trener','$pom1','$pom2')";
     mysqli_query($db,$sql);
     header("location:Ekipe.php");    
   }
?>
