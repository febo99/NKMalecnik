<?php
session_start();
include "login/config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$id = mysqli_real_escape_string($db, $_POST['igralecID']);
	echo("<script>console.log('PHP: ".$id."');</script>");
	$sqlIgralec = "DELETE FROM igralci WHERE `ID` = '$id'";
	$sqlTreningi = "DELETE FROM prisotnost WHERE `igralecID` = '$id'";
	$sqlTekme = "DELETE FROM prisotnostTekme WHERE `igralecID` = '$id'";
	$queryIgralec = mysqli_query($db,$sqlIgralec);
	$queryTrening = mysqli_query($db,$sqlTreningi);
	$queryTekma = mysqli_query($db,$sqlTekme);
	header("location:Vsi_igralci/Vsi_igralci.php");
}
?>