<?php
include "../login/config.php";
setlocale(LC_TIME, 'sl_SI'); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST["mesec"]) {
		$mesec = mysqli_real_escape_string($db, $_POST['izbraniMesec']);
		$sqlIgralci = "SELECT * FROM igralci";
		$sqlMesec = "SELECT * FROM placilnaLista WHERE `mesec` = '$mesec'";
		$queryIgralci = mysqli_query($db, $sqlIgralci);
		$queryMesec = mysqli_query($db, $sqlMesec);
		echo ("<script>console.log('PHP: " . mysqli_num_rows($queryMesec) . "');</script>");
		if (mysqli_num_rows($queryMesec) == 0) {
			while ($row = mysqli_fetch_assoc($queryIgralci)) {
				$igralecID = $row['ID'];
				$ekipaID = $row['ekipaID'];
				$sqlOpravicen = "SELECT * FROM opraviceniIgralci WHERE `igralecID` = '$igralecID' AND MONTH(`datumOd`) <= '$mesec' AND MONTH(`datumDo`) >= '$mesec'";
				$queryOpravicen = mysqli_query($db, $sqlOpravicen);
				if (mysqli_num_rows($queryOpravicen) > 0 || $ekipaID == 17 || $ekipaID == 15) {
					$sqlVnos = "INSERT INTO placilnaLista(igralecID,ekipaID,mesec,statusPlacila) VALUES('$igralecID','$ekipaID','$mesec',3)";
					mysqli_query($db, $sqlVnos);
					echo "dodano";
				} else {
					$sqlVnos = "INSERT INTO placilnaLista(igralecID,ekipaID,mesec,statusPlacila) VALUES('$igralecID','$ekipaID','$mesec',1)";
					mysqli_query($db, $sqlVnos);
					echo "dodano";
				}
			}
			header("location: Placilna_lista.php");
		}else{
			$obvestilo = "Plačila za ta mesec so že vnešena!";
			echo "<script type='text/javascript'>alert('$obvestilo');
			window.location.href='./Placilna_lista.php';</script>";
		}
	}
	if ($_POST['excel']) {
		$mesec = mysqli_real_escape_string($db, $_POST['izbraniMesec']);
		if ($mesec == 1) $mesec = 'Januar';
		else if ($mesec == 2) $mesec = 'Februar';
		else if ($mesec == 3) $mesec = 'Marec';
		else if ($mesec == 4) $mesec = 'April';
		else if ($mesec == 5) $mesec = 'Maj';
		else if ($mesec == 6) $mesec = 'Junij';
		else if ($mesec == 7) $mesec = 'Julij';
		else if ($mesec == 8) $mesec = 'Avgust';
		else if ($mesec == 9) $mesec = 'September';
		else if ($mesec == 10) $mesec = 'Oktober';
		else if ($mesec == 11) $mesec = 'November';
		else if ($mesec == 12) $mesec = 'December';
		include "../login/config.php";
		include '../Export/xlsxwriter.class.php';
		$filename = "placila" . $mesec . ".xlsx";
		header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		$mesecD = $_POST['izbraniMesec'];
		$query = "SELECT * FROM placilnaLista INNER JOIN igralci ON placilnaLista.igralecID = igralci.ID WHERE placilnaLista.statusPlacila = 1 AND placilnaLista.mesec = '$mesecD' ";
		$result = mysqli_query($db, $query);
		//$rows = mysqli_fetch_assoc($result);
		$header = array(
			'Ime' => 'string',
			'Priimek' => 'string',
			'Ulica' => 'string',
			'Pošta' => 'string',
			'Mesto' => 'string',
			$mesec => 'string'
		);
		$writer = new XLSXWriter();
		$mesecArray[0] = "Mesec: " . $mesec;
		$writer->writeSheetHeader('Podatki', $header, $col_options = ['widths' => [10, 20, 20, 10, 20,20], 'suppress_row' => false]);
		$array = array();
		while ($row = $result->fetch_assoc()) {
			$array[0] = $row['ime'];
			$array[1] = $row['priimek'];
			$array[2] = $row['ulica'];
			$array[3] = $row['postnaStevilka'];
			$array[4] = $row['mesto'];
			$writer->writeSheetRow('Podatki', $array);
		};
		$writer->writeToStdOut();
		exit(0);
	}
}
