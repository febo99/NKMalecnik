<?php
include "../login/config.php";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $ime = mysqli_real_escape_string($db,$_POST['ime']);
     $priimek = mysqli_real_escape_string($db,$_POST['priimek']);
     $datumRojstva = mysqli_real_escape_string($db,$_POST['datumRojstva']);
     $letnik = mysqli_real_escape_string($db,$_POST['letnik']);
     $ulica = mysqli_real_escape_string($db,$_POST['ulica']);
     $postnaStevilka = mysqli_real_escape_string($db,$_POST['postnaStevilka']);
     $mesto = mysqli_real_escape_string($db,$_POST['mesto']);
     $sola = mysqli_real_escape_string($db,$_POST['sola']);
     $telefonIgralec = mysqli_real_escape_string($db,$_POST['telefonIgralec']);
     $emailIgralec = mysqli_real_escape_string($db,$_POST['emailIgralec']);
     $nazivStars1 = mysqli_real_escape_string($db,$_POST['nazivStars1']);
     $telefonStars1 = mysqli_real_escape_string($db,$_POST['telefonStars1']);
     $emailStars1 = mysqli_real_escape_string($db,$_POST['emailStars1']);
     $nazivStars2 = mysqli_real_escape_string($db,$_POST['nazivStars2']);
     $telefonStars2 = mysqli_real_escape_string($db,$_POST['telefonStars2']);
     $emailStars2 = mysqli_real_escape_string($db,$_POST['emailStars2']);
     $emso = mysqli_real_escape_string($db,$_POST['emso']);
     $registracijskaStevilka = mysqli_real_escape_string($db,$_POST['registracijskaStevilka']);
     $opombe = mysqli_real_escape_string($db,$_POST['opombe']);
     $ustvaril = $_SESSION['id'];
     $ekipa = mysqli_real_escape_string($db,$_POST['ekipa']);
     $sql = "INSERT INTO igralci(ime,priimek ,datumRojstva ,letnik ,ulica ,postnaStevilka ,mesto ,sola ,telefonIgralec ,emailIgralec ,nazivStars1 ,telefonStars1 ,emailStars1 ,nazivStars2 ,telefonStars2 ,emailStars2 ,emso ,registracijskaStevilka ,opombe,ustvaril,ekipaID) VALUES ('$ime','$priimek','$datumRojstva','$letnik','$ulica','$postnaStevilka','$mesto','$sola','$telefonIgralec','$emailIgralec','$nazivStars1','$telefonStars1','$emailStars1','$nazivStars2','$telefonStars2','$emailStars2','$emso','$registracijskaStevilka','$opombe','$ustvaril','$ekipa')";
     $result = mysqli_query($db,$sql);
     header("location:Nov_igralec.php");    

}
