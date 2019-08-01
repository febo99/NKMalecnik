<?php
include "../login/config.php";
include('login/session.php');
session_start();
$sql = "SELECT * FROM igralci ORDER BY `ekipaID` ";
$get = mysqli_query($db, $sql);
$table = "";
$vloga = $_SESSION['vloga'];
while ($row = mysqli_fetch_assoc($get)) {
	$idEkipe = $row['ekipaID'];
	$sqlIme = "SELECT * FROM ekipe WHERE `ID` = '$idEkipe'";
	$getIme = mysqli_query($db, $sqlIme);
	$imeEkipe = mysqli_fetch_row($getIme);
	$idIgralca = $row['ID'];
	$table .= "<tr onclick='focusT(this);' ><td>" . $row['ime'] . " " . $row['priimek'] . "(" . $imeEkipe[1] .  ")</td>";
	if ($vloga == 1 || $vloga == 2 || $vloga == 3 || $row['ustvaril'] == $_SESSION['id'] || $imeEkipe[2] == $_SESSION['id'] || $imeEkipe[3] == $_SESSION['id'] || $imeEkipe[4] == $_SESSION['id']) {
		for ($i = 1; $i <= 12; $i++) {
			$sqlPlaca = "SELECT * FROM placilnaLista WHERE `igralecID` = '$idIgralca' AND `mesec` = '$i'";
			$queryPlaca = mysqli_query($db, $sqlPlaca);
			if (mysqli_num_rows($queryPlaca) == 0) {
				$table .= "<td class=niVnosa> </td>";
			} else {
				$rowPlaca = mysqli_fetch_assoc($queryPlaca);
				if ($rowPlaca['statusPlacila'] == 1) {
					$table .= "<td class=cakamo> </td>";
				} else if ($rowPlaca['statusPlacila'] == 2) {
					$table .= "<td class=placano> </td>";
				} else if ($rowPlaca['statusPlacila'] == 3) {
					$table .= "<td class=opravicen> </td>";
				}
			}
		}
	}
	$table .= "</tr>";
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
					<div class="col-9">
						<input type="text" id="iskanje" class="form-control" onkeyup="isciE()" placeholder="Iskanje...">
					</div>
					<div class="col-1">
						<form name="exportExcel" action="../Export/excel.php" method="post">
							<input type="submit" name="export" class="btn btn-secondary" value="Excel">
						</form>
					</div>
				</div>
				<div class="table-responsive">
					<table id="tabela" class="table table-bordered">
						<thead>
							<tr>
								<th scope="col">Ime in priimek</th>
								<th scope="col">
									<form action="Dodaj_mesec.php" method="post">
										<input type="hidden" value=1 name="mesec">
										<button type="submit" name="your_name" value="your_value" class="btn-link">Jan.</button>
									</form>
								</th>
								<th scope="col">
									<form action="Dodaj_mesec.php" method="post">
									<input type="hidden" value=2 name="mesec">
										<button type="submit" name="your_name" value="your_value" class="btn-link">Feb.</button>
									</form>
								</th>
								<th scope="col">
									<form action="Dodaj_mesec.php" method="post">
									<input type="hidden" value=3 name="mesec">
										<button type="submit" name="your_name" value="your_value" class="btn-link">Mar.</button>
									</form>
								</th>
								<th scope="col">
									<form action="Dodaj_mesec.php" method="post">
									<input type="hidden" value=4 name="mesec">
										<button type="submit" name="your_name" value="your_value" class="btn-link">Apr.</button>
									</form>
								</th>
								<th scope="col">
									<form action="Dodaj_mesec.php" method="post">
									<input type="hidden" value=5 name="mesec">
										<button type="submit" name="your_name" value="your_value" class="btn-link">Maj</button>
									</form>
								</th>
								<th scope="col">
									<form action="Dodaj_mesec.php" method="post">
									<input type="hidden" value=6 name="mesec">
										<button type="submit" name="your_name" value="your_value" class="btn-link">Jun.</button>
									</form>
								</th>
								<th scope="col">
									<form action="Dodaj_mesec.php" method="post">
									<input type="hidden" value=7 name="mesec">
										<button type="submit" name="your_name" value="your_value" class="btn-link">Jul.</button>
									</form>
								</th>
								<th scope="col">
									<form action="Dodaj_mesec.php" method="post">
									<input type="hidden" value=8 name="mesec">
										<button type="submit" name="your_name" value="your_value" class="btn-link">Avg.</button>
									</form>
								</th>
								<th scope="col">
									<form action="Dodaj_mesec.php" method="post">
									<input type="hidden" value=9 name="mesec">
										<button type="submit" name="your_name" value="your_value" class="btn-link">Sep.</button>
									</form>
								</th>
								<th scope="col">
									<form action="Dodaj_mesec.php" method="post">
									<input type="hidden" value=10 name="mesec">
										<button type="submit" name="your_name" value="your_value" class="btn-link">Okt.</button>
									</form>
								</th>
								<th scope="col">
									<form action="Dodaj_mesec.php" method="post">
									<input type="hidden" value=11 name="mesec">
										<button type="submit" name="your_name" value="your_value" class="btn-link">Nov.</button>
									</form>
								</th>
								<th scope="col">
									<form action="Dodaj_mesec.php" method="post">
									<input type="hidden" value=12 name="mesec">
										<button type="submit" name="your_name" value="your_value" class="btn-link">Dec.</button>
									</form>
								</th>
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
		</div>

</body>

</html>