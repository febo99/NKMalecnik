<?php
include "../login/config.php";
include('login/session.php');
session_start();
setlocale(LC_ALL, 'sl_SI'); 
$sql = "SELECT placilnaLista.*,ekipe.imeEkipe,igralci.ime,igralci.priimek FROM placilnaLista INNER JOIN igralci ON placilnaLista.igralecID = igralci.ID INNER JOIN ekipe ON placilnaLista.ekipaID = ekipe.ID";
$query = mysqli_query($db, $sql);
$table = "";
while ($row = mysqli_fetch_assoc($query)) {
	if ($row['statusPlacila'] == 1) {
		$status = "cakamo";
	} else if ($row['statusPlacila'] == 2) {
		$status = "placano";
	} else if ($row['statusPlacila'] == 3) {
		$status = "opravicen";
	}

	setlocale(LC_TIME, 'sl_SI.UTF-8');                                              
$monthName = strftime('%B', mktime(0, 0, 0, $row['mesec']));
	$table .= "<tr><td>" . $row['ime'] . " " . $row['priimek'] . "</td><td>" . $row['imeEkipe'] . "</td><td>" . $monthName . "</td><td class=text-center><i class='fas fa-circle " . $status . "'></i><i class=beseda>" . $status . "</i></td><td class=''>
	<a href='placal.php?igralec=".$row['igralecID']."&mesec=".$row['mesec']."' class='btn btn-success btn-xs'><i class='fas fa-check'></i></a>
	<a href='cakanje.php?igralec=".$row['igralecID']."&mesec=".$row['mesec']."' class='btn btn-dark btn-xs'><i class='fas fa-undo'></i></a>
	<a href='opravici.php?igralec=".$row['igralecID']."&mesec=".$row['mesec']."' class='btn btn-danger btn-xs'><i class='fas fa-ban'></i></a>
</td></tr>";
}

?>

<html>

<head>
	<title>NK Malecnik</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<link rel="stylesheet" href="../fixed-left.css">
	<link rel="stylesheet" href="../style.css">
	<script src="../script.js"></script>
	<script async="" defer="" src="https://buttons.github.io/buttons.js"></script>

</head>

<body>
	<div id="nav-placeholder">
		<script>
			$(function() {
				$("#nav-placeholder").load("../nav.html");
				$('#tabela').DataTable({
					stateSave: true,
					"lengthMenu": [
						[10, 50, 100, -1],
						[10, 50, 100, "Vsi"]
					],
					"language": {
						"lengthMenu":     "Prikazanih _MENU_ vnosov",
							"search":         "Iskanje:",
							"emptyTable":     "No data available in table",
    						"info":           "Prikazanih _START_ - _END_ od _TOTAL_ vnosov",
							"infoEmpty":      "Showing 0 to 0 of 0 entries",
							"zeroRecords":    "Ni najdenih vnosov",
						"paginate": {
							"previous": "Nazaj",
							"next": "Naslednja"
						}
					}
				});
			});
		</script>
	</div>
	<div id="container">
		<div class="row glava">
			<!--GLAVA-->
			<div class="col-9 colGlava">
				<h1>Plačilna lista</h1>
			</div>
			<div class="col-2 colGlava divNovGumb">
			</div>
		</div>
		<div class="row kavarna">
			<!--KAVARNA-->
			<div class="col colKavarna">
				<div class="row" style="margin-top:0.5vh;margin-left:1vh;">
					<div class="col">
						<form name="izbraniMesec" action="Dodaj_mesec.php" method="post" target=iframe>
							<select name="izbraniMesec">
								<option value=1>Januar</option>
								<option value=2>Februar</option>
								<option value=3>Marec</option>
								<option value=4>April</option>
								<option value=5>Maj</option>
								<option value=6>Junij</option>
								<option value=7>Julij</option>
								<option value=8>Avgust</option>
								<option value=9>September</option>
								<option value=10>Oktober</option>
								<option value=11>November</option>
								<option value=12>December</option>
							</select>
							<input type="submit" name="mesec" class="btn btn-primary" value="Dodaj placilo">
							<input type="submit" name="excel" class="btn btn-primary" value="Excel">
						</form>
					</div>
				</div>
				<table id="tabela" class="table table-bordered" >
					<thead>
						<tr>
							<th scope="col">Ime in priimek</th>
							<th scope="col">Selekcija</th>
							<th scope="col">Mesec</th>
							<th scope="col">Status</th>
							<th scope="col">Izbira</th>
						</tr>
					</thead>
					<tbody>
						<?php
						echo $table;
						?>
					</tbody>
				</table>
			</div>
		</div>
		<iframe name="iframe" style="display:none;"><?php
include "../login/config.php";
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
		include "../login/config.php";
		include '../Export/xlsxwriter.class.php';
		$filename = "placilo" . $mesec . ".xlsx";
		header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		$mesec = $_POST['izbraniMesec'];
		$query = "SELECT * FROM placilnaLista INNER JOIN igralci ON placilnaLista.igralecID = igralci.ID WHERE placilnaLista.statusPlacila = 1 AND placilnaLista.mesec = '$mesec' ";
		$result = mysqli_query($db, $query);
		//$rows = mysqli_fetch_assoc($result);
		$header = array(
			'Ime' => 'string',
			'Priimek' => 'string',
			'Ulica' => 'string',
			'Pošta' => 'string',
			'Mesto' => 'string',
			'Mesec' => 'string',

		);
		$writer = new XLSXWriter();
		$writer->writeSheetHeader('Podatki', $header, $col_options = ['widths' => [10, 20, 20, 10, 20, 20], 'suppress_row' => false]);
		$array = array();
		while ($row = $result->fetch_assoc()) {
			$array[0] = $row['ime'];
			$array[1] = $row['priimek'];
			$array[2] = $row['ulica'];
			$array[3] = $row['postnaStevilka'];
			$array[4] = $row['mesto'];
			if ($row['mesec'] == 1) $array[5] = 'Januar';
			else if ($row['mesec'] == 2) $array[5] = 'Februar';
			else if ($row['mesec'] == 3) $array[5] = 'Marec';
			else if ($row['mesec'] == 4) $array[5] = 'April';
			else if ($row['mesec'] == 5) $array[5] = 'Maj';
			else if ($row['mesec'] == 6) $array[5] = 'Junij';
			else if ($row['mesec'] == 7) $array[5] = 'Julij';
			else if ($row['mesec'] == 8) $array[5] = 'Avgust';
			else if ($row['mesec'] == 9) $array[5] = 'September';
			else if ($row['mesec'] == 10) $array[5] = 'Oktober';
			else if ($row['mesec'] == 11) $array[5] = 'November';
			else if ($row['mesec'] == 12) $array[5] = 'December';
			$writer->writeSheetRow('Podatki', $array);
		};
		$writer->writeToStdOut();
		exit(0);
	}
}
?></iframe>
</body>

</html>