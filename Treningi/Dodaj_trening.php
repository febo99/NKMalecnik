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
     $vmes = date('Y-m-d H:i', strtotime("$datum  $ura"));
     $zacetek = date('Y-m-d\\TH:i:s', strtotime("$datum  $ura"));
     $izracun = new DateTime($vmes);
     $izracun->add(new DateInterval('PT' . $trajanje . 'M'));
     $konec = $izracun->format('Y-m-d\\TH:i:s');
     $id = $_SESSION['id'];

     //FILE UPLOAD
     if($_FILES['priponka']['name'] != "") {
       $shraniDir = "priponke/";
       $dir = $shraniDir .  basename(str_replace(" ","_",$_FILES["priponka"]["name"]));
       move_uploaded_file($_FILES["priponka"]["tmp_name"], $dir);
       //SHRANI TRENING
       $sql = "INSERT INTO treningi(naslov,datum,ekipaID,lokacijaID,ustvaril,zacetek,konec,priponka) VALUES ('$naslov','$datum','$ekipa','$lokacija','$id','$zacetek','$konec','$dir')";
       $result = mysqli_query($db,$sql);
    }
    else{
      $sql = "INSERT INTO treningi(naslov,datum,ekipaID,lokacijaID,ustvaril,zacetek,konec) VALUES ('$naslov','$datum','$ekipa','$lokacija','$id','$zacetek','$konec')";
      $result = mysqli_query($db,$sql);
    }

     //PRISOTNOST
     $vsiIgralci = "SELECT * FROM igralci WHERE `ekipaID` = '$ekipa'";
     $get = mysqli_query($db,$vsiIgralci);
     $aiS = "SELECT `AUTO_INCREMENT`
            FROM  INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = 'NKMalecnik'
            AND   TABLE_NAME   = 'treningi'";
      $aiQ = mysqli_query($db,$aiS);
      $ai = mysqli_fetch_row($aiQ);
      $idT = $ai[0] - 1;
     while($row = mysqli_fetch_assoc($get)){
       $idD = $row['ID'];
       $sqlT = "INSERT INTO prisotnost(treningID,igralecID) VALUES ('$idT','$idD')";
       mysqli_query($db,$sqlT);
     }
     header("location:Nov_trening.php");
  }
?>
