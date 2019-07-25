<?php
session_start();
include "../login/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$id = mysqli_real_escape_string($db, $_POST['tekmaID']);
	$sql = "DELETE FROM tekme WHERE `ID` = '$id'";
	$get = mysqli_query($db,$sql);
	$sqlTreningiP = "DELETE FROM prisotnostTekme WHERE `tekmaID` = '$id'";
	header("location:Vse_tekme.php");
}
?>