<?php
include "../login/config.php";
	 $igralec = $_GET['igralec'];
	 $mesec = $_GET['mesec'];
	 echo("<script>console.log('PHP: " . $mesec . " ". $igralec. "');</script>");
     $sql = "UPDATE placilnaLista SET `statusPlacila` = 1 WHERE `igralecID` = '$igralec' AND `mesec` = '$mesec'";
	mysqli_query($db,$sql);
	header("location:Placilna_lista.php");
?>