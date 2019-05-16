<?php
include "../login/config.php";
session_start();
$sql = "SELECT * FROM treningi";
$get = mysqli_query($db,$sql);
$eventi = array();
while($row = mysqli_fetch_assoc($get)){
  $e = array();
  $id = $row['ekipaID'];
  $sqlEkipa = "SELECT * FROM ekipe WHERE `ID` = '$id'";
  $ekipaQuery = mysqli_query($db,$sqlEkipa);
  $ekipa = mysqli_fetch_assoc($ekipaQuery);
  $imeEkipe = $ekipa['imeEkipe'];
  $e['title'] = $imeEkipe ." ".$row['naslov'] . " - trening";
  $e['start'] = $row['zacetek'];
  $e['end'] = $row['konec'];
  array_push($eventi,$e);
}
echo json_encode($eventi);
exit();
?>
