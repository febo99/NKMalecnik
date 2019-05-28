<?php
include "../login/config.php";
session_start();
header("Content-type: application/json; charset=utf-8");
$sql = "SELECT * FROM prisotnost INNER JOIN treningi ON prisotnost.treningID=treningi.ID ORDER BY treningi.datum";
$vsiTrening = "SELECT * FROM treningi";
$getT = mysqli_query($db,$vsiTrening);
$get = mysqli_query($db,$sql);
$stevilo = mysqli_num_rows($getT);
$eventi = array();
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
echo json_encode($eventi,JSON_UNESCAPED_UNICODE);
exit();
?>
