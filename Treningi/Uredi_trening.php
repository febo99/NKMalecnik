<?php
include "../login/config.php";
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $naslov = mysqli_real_escape_string($db,$_POST['naslovTrening']);
     $datum = mysqli_real_escape_string($db,$_POST['datumTrening']);
     $ura = mysqli_real_escape_string($db,$_POST['uraTreninga']);
     $trajanje = mysqli_real_escape_string($db,$_POST['trajanje']);
     $lokacija = mysqli_real_escape_string($db,$_POST['lokacijaTrening']);
     $ekipa = mysqli_real_escape_string($db,$_POST['ekipa']);
     $porocilo = mysqli_real_escape_string($db,$_POST['porocilo']);
     $uvod = mysqli_real_escape_string($db,$_POST['uvod']);
     $glavni = mysqli_real_escape_string($db,$_POST['glavni']);
     $zakljucni = mysqli_real_escape_string($db,$_POST['zakljucni']);
     $idTrening = mysqli_real_escape_string($db,$_POST['treningID']);
     $vmes = date('Y-m-d H:i', strtotime("$datum  $ura"));
     $zacetek = date('Y-m-d\\TH:i:s', strtotime("$datum  $ura"));
     $izracun = new DateTime($vmes);
     $izracun->add(new DateInterval('PT' . $trajanje . 'M'));
     $konec = $izracun->format('Y-m-d\\TH:i:s');
     $id = $_SESSION['id'];
        $sql = "UPDATE treningi SET `naslov` = '$naslov',`datum` = '$datum',`ekipaID` = '$ekipa',`uvod` = '$uvod',`glavni` = '$glavni',
        `zakljucek` = '$zakljucni',`porocilo` = '$porocilo',`lokacijaID` = '$lokacija',`ustvaril` = '$id',
        `zacetek` = '$zacetek',`konec` = '$konec' WHERE `ID` = '$idTrening'"; 
       $result = mysqli_query($db,$sql);
     }
     header("location:Urejanje_trening.php?id=".$idTrening);
?>
