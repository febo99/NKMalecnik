<?php
include "../login/config.php";
session_start();
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
  header("location: ../index.php");
}
if ($_SESSION['vloga'] == 1 ||$_SESSION['vloga'] == 2) {
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$ime = mysqli_real_escape_string($db, $_POST['ime']);
		$priimek = mysqli_real_escape_string($db, $_POST['priimek']);
		$vloga = mysqli_real_escape_string($db, $_POST['vloga']);
		$staroGeslo = mysqli_real_escape_string($db, $_POST['staroGeslo']);
		$novoGeslo = mysqli_real_escape_string($db, $_POST['geslo']);
		$id = mysqli_real_escape_string($db, $_POST['id']);
		$sqlPwd = "SELECT * FROM uporabniki WHERE `ID` = '$id'";
		$queryPwd = mysqli_query($db,$sqlPwd);
		$pwd = mysqli_fetch_assoc($queryPwd);
		if(empty($staroGeslo) && empty($novoGeslo)){
			$sql = "UPDATE uporabniki SET `email` = '$email',`ime` = '$ime',`priimek` = '$priimek',`vloga` = '$vloga' WHERE `ID` = '$id'";
			mysqli_query($db, $sql);
			header("Location: Uporabniki.php");
		}else if(!empty($staroGeslo) && !empty($novoGeslo) && $staroGeslo == $pwd['geslo']){
			$sql = "UPDATE uporabniki SET `email` = '$email',`ime` = '$ime',`priimek` = '$priimek',`vloga` = '$vloga',`geslo` = '$novoGeslo' WHERE `ID` = '$id'";
			mysqli_query($db, $sql);
			header("Location: Uporabniki.php");
		}
	}
}else header("Location: Uporabniki.php");
?>