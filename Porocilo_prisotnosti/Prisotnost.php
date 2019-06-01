<?php
include "../login/config.php";
session_start();
header("Content-type: application/json; charset=utf-8");
$json = array();
$sql = "SELECT * FROM ekipe";
$basic = mysqli_query($db,$sql);
$ekipe = array();
$ekipa = array();
$treningi = array();
while($row = mysqli_fetch_assoc($basic)){
  $ime = $row['imeEkipe'];
  $idEkipe = $row['ID'];
  $ekipa['trening'] = array();
  $ekipa['ekipa'] = $ime;
  $sqlTrening = "SELECT * FROM treningi WHERE `ekipaID` = '$idEkipe'";
  $treningQ = mysqli_query($db,$sqlTrening);
  while($row = mysqli_fetch_assoc($treningQ)){
    $ekipa['trening']['ID'] = $row['ID'];
    $ekipa['trening']['datum'] = $row['datum'];
    $ekipa['trening']['naslov'] = $row['naslov'];
    $ekipa['trening']['prisotni'] = array();

  }
  array_push($ekipe,$ekipa);
}
array_push($json,$ekipe);
//array_push($eventi,$stevilo);
while($row = mysqli_fetch_assoc($get)){
  $e = array();
  $id = $row['ID'];
  $prisoten = $row['prisotnost'];

  $treningID = $row['treningID'];
  $igralecID = $row['igralecID'];
  $ekipaID = $row['ekipaID'];

  $sqlTrening = "SELECT * FROM treningi WHERE `ID` = '$treningID' ORDER BY `datum` DESC";
  $sqlIgralec = "SELECT * FROM igralci WHERE `ID` = '$igralecID'";

  $sqlEkipaStevilo = "SELECT 'ekipaID' FROM igralci WHERE `ekipaID` = '$ekipaID'";
  $ekipaQuery = mysqli_query($db,$sqlEkipaStevilo);
  $steviloIgralcev = mysqli_num_rows($ekipaQuery);

  $treningQuery = mysqli_query($db,$sqlTrening);
  $trening = mysqli_fetch_assoc($treningQuery);
  $igralecQuery = mysqli_query($db,$sqlIgralec);
  $igralec = mysqli_fetch_assoc($igralecQuery);
  $ekipa = $trening['ekipaID'];
  $datum = $trening['datum'];
  $e['id'] = $id;
  $e['prisotnost'] = $prisoten;
  $e['ime'] = $igralec['ime']. " ".$igralec['priimek'];
  $e['datum'] = $datum;
  $e['ekipa'] = $ekipa;
  $e['steviloIgralcev'] = $steviloIgralcev;

  array_push($eventi,$e);
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
exit();
?>
