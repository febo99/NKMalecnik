<?php
session_start();
include "../login/config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$id = mysqli_real_escape_string($db, $_POST['ekipaID']);
	$sql = "SELECT * FROM treningi WHERE `ekipaID` = '$id'";
	$get = mysqli_query($db,$sql);
	while ($row = mysqli_fetch_assoc($get)) {
		$treningID = $row['ID'];
		$sqlTreningiP = "DELETE FROM prisotnost WHERE `treningID` = '$treningID'";
		$queryTreningP = mysqli_query($db,$sqlTreningiP);
	}
	$sql = "SELECT * FROM tekme WHERE `ekipaID` = '$id'";
	$get = mysqli_query($db,$sql);
	while ($rowT = mysqli_fetch_assoc($get)) {
		$tekmaID = $rowT['ID'];
		$sqlTekmeP = "DELETE FROM prisotnostTekme WHERE `tekmaID` = '$tekmaID'";
		$queryTekmeP = mysqli_query($db,$sqlTekmeP);
	}
	$sqlTrening = "DELETE FROM treningi WHERE `ekipaID` = '$id'";
	$queryTrening = mysqli_query($db,$sqlTrening);
	$sqlTekme = "DELETE FROM tekme WHERE `ekipaID` = '$id'";
	$queryTekme = mysqli_query($db,$sqlTekme);
	$sqlEkipa = "DELETE FROM ekipe WHERE `ID` = '$id'";
	$queryEkipa = mysqli_query($db,$sqlEkipa);
	header("location:Ekipe.php");
}
?>