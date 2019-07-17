<?php
session_start();
include "../login/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$id = mysqli_real_escape_string($db, $_POST['treningID']);
	$sql = "DELETE FROM treningi WHERE `ID` = '$id'";
	$get = mysqli_query($db,$sql);
	$sqlTreningiP = "DELETE FROM prisotnost WHERE `treningID` = '$id'";
	header("location:Vsi_treningi.php");
}
?>