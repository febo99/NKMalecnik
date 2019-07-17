<?php
include "../login/config.php";
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $tip = mysqli_real_escape_string($db,$_POST['tipTekme']);
     $lokacija = mysqli_real_escape_string($db,$_POST['domaGost']);
     $uraT = mysqli_real_escape_string($db,$_POST['uraTekme']);
     $uraZ = mysqli_real_escape_string($db,$_POST['uraZbora']);
     $datum = mysqli_real_escape_string($db,$_POST['datumTekme']);
     $ekipa = mysqli_real_escape_string($db,$_POST['ekipa']);
     $lokacijaID = mysqli_real_escape_string($db,$_POST['domacaLokacija']);
     $lokacijaIme = mysqli_real_escape_string($db,$_POST['lokacija']);
     $golD = mysqli_real_escape_string($db,$_POST['domaciGoli']);
     $golG = mysqli_real_escape_string($db,$_POST['nasprotnikGoli']);
     $nasprotnik = mysqli_real_escape_string($db,$_POST['nasprotnik']);
     $vmes = date('Y-m-d H:i', strtotime($datum . " " . $uraZ));
     $zacetek = date('Y-m-d\\TH:i:s', strtotime($datum . " " .  $uraZ));
     $izracun = new DateTime($vmes);
     $izracun->add(new DateInterval('PT120M'));
     $konec = $izracun->format('Y-m-d\\TH:i:s');
     $id = $_SESSION['id'];
    if(!empty($lokacijaID)){
        $sql = "SELECT * FROM lokacije WHERE `ID` = '$lokacijaID'";
        $query = mysqli_query($db,$sql);
        $row = mysqli_fetch_row($query);
        $lokacijaIme = $row[1];
    }else{
        $lokacijaID = 0;
        $lokacijaIme = mysqli_real_escape_string($db,$_POST['lokacija']);
    }
    $sql = "INSERT INTO tekme(lokacija,tip,ekipaID,nasprotnik,datum,uraZbora,uraTekme,lokacijaID,imeLokacije,golDomaci,golGosti,ustvaril,zacetek,konec) VALUES
     ('$lokacija','$tip','$ekipa','$nasprotnik','$datum','$uraZ','$uraT','$lokacijaID','$lokacijaIme','$golD','$golG','$id','$zacetek','$konec')";
     mysqli_query($db,$sql);


    //PRISOTNOST

     $vsiIgralci = "SELECT * FROM igralci WHERE `ekipaID` = '$ekipa'";
     $get = mysqli_query($db,$vsiIgralci);
     $aiS = "SELECT `AUTO_INCREMENT`
            FROM  INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = 'NKMalecnik'
            AND   TABLE_NAME   = 'tekme'";
      $aiQ = mysqli_query($db,$aiS);
      $ai = mysqli_fetch_row($aiQ);
      $idT = $ai[0] - 1;
     while($row = mysqli_fetch_assoc($get)){
       $idD = $row['ID'];
       $sqlT = "INSERT INTO prisotnostTekme(tekmaID,igralecID) VALUES ('$idT','$idD')";
       mysqli_query($db,$sqlT);
     }
     header("location:Nova_tekma.php");
   }
