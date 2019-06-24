<?php
include "../login/config.php";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $tip = mysqli_real_escape_string($db,$_POST['tipTekme']);
     $lokacijaT = mysqli_real_escape_string($db,$_POST['domaGost']);
     $ekipa = mysqli_real_escape_string($db,$_POST['ekipa']);
     $nasprotnik = mysqli_real_escape_string($db,$_POST['nasprotnik']);
	 $idTekme = mysqli_real_escape_string($db,$_POST['idTekme']);
	 $datumTekme = mysqli_real_escape_string($db,$_POST['datumTekme']);
	 $uraTekme = mysqli_real_escape_string($db,$_POST['uraTekme']);
	 $uraZbora = mysqli_real_escape_string($db,$_POST['uraZbora']);
	 $lokacijaID = mysqli_real_escape_string($db,$_POST['domacaLokacija']);
	 $lokacijaIme = mysqli_real_escape_string($db,$_POST['lokacija']);
	 $golDomaci = mysqli_real_escape_string($db,$_POST['domaciGoli']);
	 $golGosti = mysqli_real_escape_string($db,$_POST['nasprotnikGoli']);
	 $vmes = date('Y-m-d H:i', strtotime("$datum  $uraZbora"));
     $zacetek = date('Y-m-d\\TH:i:s', strtotime("$datum  $uraZbora"));
     $izracun = new DateTime($vmes);
     $izracun->add(new DateInterval('PT120M'));
	 $konec = $izracun->format('Y-m-d\\TH:i:s');
	 if(!empty($lokacijaID)){
        $sql = "SELECT * FROM lokacije WHERE `ID` = '$lokacijaID'";
        $query = mysqli_query($db,$sql);
        $row = mysqli_fetch_row($query);
        $lokacijaIme = $row[1];
    }else{
        $lokacijaID = 0;
        $lokacijaIme = mysqli_real_escape_string($db,$_POST['lokacija']);
    }
     $sql = "UPDATE tekme SET `lokacija` = '$lokacijaT',`tip` = '$tip',`ekipaID` = '$ekipa',`nasprotnik` = '$nasprotnik',`datum` = '$datumTekme',`uraZbora` = '$uraZbora',
	 `uraTekme` = '$uraTekme',`lokacijaID` = '$lokacijaID',`imeLokacije` = '$lokacijaIme',`golDomaci` = '$nasprotnik',`golGosti` = '$nasprotnik',`zacetek` = '$zacetek',`konec` = '$konec' WHERE `ID` = '$idTekme'";
    mysqli_query($db,$sql);
     header("location:Tekma.php?id=".$idTekme);    
   }
?>
