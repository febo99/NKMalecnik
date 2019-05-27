<?php
include "../login/config.php";
session_start();
header("Content-type: application/json; charset=utf-8");
$sql = "SELECT * FROM prisotnost";
$vsiTrening = "SELECT * FROM treningi";
$getT = mysqli_query($db,$vsiTrening);
$get = mysqli_query($db,$sql);
$stevilo = mysqli_num_rows($getT);
$eventi = array();
array_push($eventi,$stevilo);
while($row = mysqli_fetch_assoc($get)){
  $e = array();
  $id = $row['ID'];
  $prisoten = $row['prisotnost'];

  $treningID = $row['treningID'];
  $igralecID = $row['igralecID'];

  $sqlTrening = "SELECT * FROM treningi WHERE `ID` = '$treningID'";
  $sqlIgralec = "SELECT * FROM igralci WHERE `ID` = '$igralecID'";


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

  array_push($eventi,$e);
}
echo json_encode($eventi,JSON_UNESCAPED_UNICODE);
exit();
?>
