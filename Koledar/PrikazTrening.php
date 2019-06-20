<?php
include "../login/config.php";
session_start();
$sql = "SELECT * FROM treningi";
$get = mysqli_query($db,$sql);
$eventi = array();
while($row = mysqli_fetch_assoc($get)){
  $e = array();
  $id = $row['ekipaID'];
  $lok = $row['lokacijaID'];
  $sqlEkipa = "SELECT * FROM ekipe WHERE `ID` = '$id'";
  $sqlBarva = "SELECT * FROM lokacije WHERE `ID` = '$lok'";
  $barvaQuery = mysqli_query($db,$sqlBarva);
  $barva = mysqli_fetch_assoc($barvaQuery);
  $ekipaQuery = mysqli_query($db,$sqlEkipa);
  $ekipa = mysqli_fetch_assoc($ekipaQuery);
  $imeEkipe = $ekipa['imeEkipe'];
  $e['title'] = $imeEkipe ." \n".$row['naslov'] . " - trening\n Lokacija: ".$barva['ime'];
  $e['start'] = $row['zacetek'];
  $e['end'] = $row['konec'];
  $e['color'] = $barva['barva'];
  array_push($eventi,$e);
}
$sql = "SELECT * FROM tekme";
$get = mysqli_query($db,$sql);
while($row = mysqli_fetch_assoc($get)){
  $e = array();
  $id = $row['ekipaID'];
  $sqlEkipa = "SELECT * FROM ekipe WHERE `ID` = '$id'";
  $ekipaQuery = mysqli_query($db,$sqlEkipa);
  $ekipa = mysqli_fetch_assoc($ekipaQuery);
  $imeEkipe = $ekipa['imeEkipe'];
  if($row['lokacija'] == 1)$barva = "orange";
  else $barva = "green";
  $e['title'] = $imeEkipe ." - ".$row['nasprotnik'] . " \n tekma\n Lokacija: ".$row['imeLokacije'];
  $e['start'] = $row['zacetek'];
  $e['end'] = $row['konec'];
  $e['color'] = $barva;
  array_push($eventi,$e);
}
echo json_encode($eventi);
exit();
?>
