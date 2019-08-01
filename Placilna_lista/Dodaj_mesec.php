<?php
include "../login/config.php";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $mesec = mysqli_real_escape_string($db,$_POST['mesec']);
	$sqlIgralci = "SELECT * FROM igralci";
	$sqlMesec = "SELECT * FROM placilnaLista WHERE `mesec` = '$mesec'";
	$queryIgralci = mysqli_query($db,$sqlIgralci);
	$queryMesec = mysqli_query($db,$sqlMesec);
	echo ("<script>console.log('PHP: " . mysqli_num_rows($queryMesec) . "');</script>");
	if(mysqli_num_rows($queryMesec) == 0){
		while($row = mysqli_fetch_assoc($queryIgralci)){
			$igralecID = $row['ID'];
			$ekipaID = $row['ekipaID'];
			$sqlOpravicen = "SELECT * FROM opraviceniIgralci WHERE `igralecID` = '$igralecID' AND MONTH(`datumOd`) <= '$mesec' AND MONTH(`datumDo`) >= '$mesec'";
			$queryOpravicen = mysqli_query($db,$sqlOpravicen);
			if(mysqli_num_rows($queryOpravicen) > 0 || $ekipaID == 17){
				$sqlVnos = "INSERT INTO placilnaLista(igralecID,ekipaID,mesec,statusPlacila) VALUES('$igralecID','$ekipaID','$mesec',3)";
				mysqli_query($db,$sqlVnos);
				echo "dodano";
			}
			else{
				$sqlVnos = "INSERT INTO placilnaLista(igralecID,ekipaID,mesec,statusPlacila) VALUES('$igralecID','$ekipaID','$mesec',1)";
				mysqli_query($db,$sqlVnos);
				echo "dodano";
			}
		}
	}
	header("location: Placilna_lista.php");
  }
