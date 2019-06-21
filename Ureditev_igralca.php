<?php
session_start();
include "login/config.php";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $ime = mysqli_real_escape_string($db,$_POST['ime']);
     $idIgralca = mysqli_real_escape_string($db,$_POST['idIgralca']);
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
     $ekipa = mysqli_real_escape_string($db,$_POST['ekipa']);
     $sql = "UPDATE igralci SET `ime` = '$ime',`priimek` = '$priimek',`datumRojstva` = '$datumRojstva',`letnik` = '$letnik',`ulica` = '$ulica',`postnaStevilka` = '$postnaStevilka',`mesto` = '$mesto',`sola` = '$sola',`telefonIgralec` = '$telefonIgralec',`emailIgralec` = '$emailIgralec',
     `nazivStars1` = '$nazivStars1',`telefonStars1` = '$telefonStars1',`emailStars1` = '$emailStars1',`nazivStars2` = '$nazivStars2',`telefonStars2` = '$telefonStars2',
     `emailStars2` = '$emailStars2',`emso` = '$emso',`registracijskaStevilka` = '$registracijskaStevilka',`opombe` = '$opombe', `ekipaID` = '$ekipa' WHERE `ID` = '$idIgralca'";
     $result = mysqli_query($db,$sql);
     header("location:Igralec.php?igralec=".$idIgralca);    
}
