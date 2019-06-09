<?php
include "../login/config.php";
session_start();
header("Content-type: application/json; charset=utf-8");
$sql = "SELECT * FROM ekipe";
$basic = mysqli_query($db,$sql);
$ekipe = array();
$ekipa = array();
$treningi = array();
while($row = mysqli_fetch_assoc($basic)){
  $ime = $row['imeEkipe'];
  $idEkipe = $row['ID'];
  $ekipa['ekipa'] = $ime;
  $ekipa['ekipaID'] = $idEkipe;
  $ekipa['treningi'] = array();
  $sqlTrening = "SELECT * FROM treningi WHERE `ekipaID` = '$idEkipe'";
  $treningQ = mysqli_query($db,$sqlTrening);
  while($row = mysqli_fetch_assoc($treningQ)){
    $trening = array();
    $treningID = $row['ID'];
    $trening['ID'] = $row['ID'];
    $trening['datum'] = $row['datum'];
    $trening['naslov'] = $row['naslov'];
    array_push($ekipa['treningi'],$trening);
    $sqlPrisotnost = "SELECT * FROM prisotnost INNER JOIN igralci ON prisotnost.igralecID = igralci.ID WHERE `treningID` = '$treningID' AND `prisotnost` = 1";
    $prisotnostQ = mysqli_query($db,$sqlPrisotnost);
    $sqlManjka = "SELECT * FROM prisotnost INNER JOIN igralci ON prisotnost.igralecID = igralci.ID WHERE `treningID` = '$treningID' AND NOT `prisotnost` = 1";
    $manjkaQ = mysqli_query($db,$sqlManjka);
    $ekipa['treningi']['steviloIgralcev'] = mysqli_num_rows($prisotnostQ) + mysqli_num_rows($manjkaQ);
    $ekipa['treningi']['prisotni'] = array();
    $ekipa['treningi']['manjkajoci'] = array();
    while($row = mysqli_fetch_assoc($prisotnostQ)){
      $igralec = $row['ime'] . " " . $row['priimek'];
      array_push($ekipa['treningi']['prisotni'],$igralec);
    }
    while($row = mysqli_fetch_assoc($manjkaQ)){
      $igralec = $row['ime'] . " " . $row['priimek'];
      array_push($ekipa['treningi']['manjkajoci'],$igralec);
    }
  }
  array_push($ekipe,$ekipa);
}
//array_push($eventi,$stevilo);
echo json_encode($ekipe,JSON_UNESCAPED_UNICODE);
exit();
?>
