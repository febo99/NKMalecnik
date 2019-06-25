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
     $id = $_SESSION['id'];
     $ure = round(abs(strtotime($konec) - strtotime($zacetek)) / 3600,2);
    $sql = "INSERT INTO delovneAkcije(naslov,datum,zacetek,konec,porocilo,ure,ustvaril) VALUES
     ('$naslov','$datum','$zacetek','$konec','$porocilo','$ure','$id')";
     mysqli_query($db,$sql);


     $vsiIgralci = "SELECT * FROM clani";
     $get = mysqli_query($db,$vsiIgralci);
     $aiS = "SELECT `AUTO_INCREMENT`
            FROM  INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = 'NKMalecnik'
            AND   TABLE_NAME   = 'delovneAkcije'";
      $aiQ = mysqli_query($db,$aiS);
      $ai = mysqli_fetch_row($aiQ);
      $idT = $ai[0] - 1;
     while($row = mysqli_fetch_assoc($get)){
       $idD = $row['ID'];
       $sqlT = "INSERT INTO prisotnostAkcije(akcijaID,clanID) VALUES ('$idT','$idD')";
       mysqli_query($db,$sqlT);
     header("location:Delovne_akcije.php");
   }
}
?>