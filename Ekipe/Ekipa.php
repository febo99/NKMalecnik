<?php
include "../login/config.php";
session_start();
$idEkipe = $_GET['id'];
$sql = "SELECT * FROM uporabniki";
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
	header("location: ../index.php");
}
$get = mysqli_query($db, $sql);
$optionTrener = "";
$optionPom1 = "";
$optionPom2 = "";
$trener = "";
$sqlEkipa = "SELECT * FROM ekipe WHERE `ID` = '$idEkipe'";
$query = mysqli_query($db, $sqlEkipa);
$ekipa = mysqli_fetch_assoc($query);
if(empty($ekipa)){
	header("Location:Ekipe.php");
}
if($ekipa['trenerID'] == $_SESSION['id'] || $ekipa['pomocnik1ID'] == $_SESSION['id'] || $ekipa['pomocnik2ID'] == $_SESSION['id'] || $_SESSION['vloga'] == 1){
	while ($row = mysqli_fetch_assoc($get)) {
		if ($row['ID'] == $ekipa['trenerID']) {
			$trener = $row['ime'] . " " . $row['priimek'];
		} 
		else if ($row['ID'] == $ekipa['pomocnik1ID']) {
			$pom1 = $row['ime'] . " " . $row['priimek'];
		}
		else if ($row['ID'] == $ekipa['pomocnik2ID']) {
			$pom2 = $row['ime'] . " " . $row['priimek'];
		} 
	}
	$sqlIgralci = "SELECT * FROM igralci WHERE `ekipaID` = '$idEkipe'";
	$queryI = mysqli_query($db,$sqlIgralci);
	$table = "";
	while ($row = mysqli_fetch_assoc($queryI)){
		$table .= "<tr><td><a href=../Igralec.php?igralec=".$row['ID'].">".$row['ime']." ".$row['priimek']."</a></td><td>".date("d.m.Y",strtotime($row['datumRojstva']))."</td>"."<td>".$row['emailIgralec']."</"."<td>"."<td>".$row['telefonIgralec']."</td><td>".$row['opomba']."</td>"."</tr>";
	}
	$prihajTreningi = "";
	$sqlTrening = "SELECT * FROM treningi INNER JOIN lokacije ON treningi.lokacijaID = lokacije.ID WHERE treningi.datum >= CURDATE() AND treningi.ekipaID = '$idEkipe' ORDER BY treningi.datum";
	$queryTrening = mysqli_query($db,$sqlTrening);
	while( $row = mysqli_fetch_assoc($queryTrening)){
		$prihajTreningi .= "<tr><td>".$row['naslov']."</td><td>".date("d.m.Y",strtotime($row['datum'])). ", " .substr($row['zacetek'],strpos($row['zacetek'],"T")+1) ."</td><td>".$row['ime']."</td></tr>";
	}
}else{
	header("Location:Ekipe.php");
}
?>

<html style="background-color: rgb(60, 68, 77);">

<head>
	<title>NK Malecnik</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	 <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="../script.js"></script>
	<link rel="stylesheet" href="../fixed-left.css">
	<link rel="stylesheet" href="../style.css">
	<script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
	<script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
	 
</head>
<body>
<div id="nav-placeholder">
    <script>
  $(function(){
    $("#nav-placeholder").load("../nav.html");
  });
  </script>
  </div>
	<div id="container">
		<div class="row glava">
			<!--GLAVA-->
			<div class="col-11 colGlava">
				<h1>Ekipa <?php echo $ekipa['imeEkipe']; ?></h1>
				<p>Trener: <?php echo $trener; ?><br>
					Pomočniki: <?php echo $pom1 . " , " . $pom2; ?></p>
			</div>
			<div class="col colGlava">
			</div>
		</div>
		<div class="row kavarna">
			<!--KAVARNA-->
			<div class="col colKavarna">
        <div class="row">
          <div class="col">
		  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
						<div class="navbar-nav">
							<a class="nav-item nav-link active tt" href="#splosno">Splošno</a>
							<a class="nav-item nav-link tt" href="#igralci">Igralci</a>
						</div>
					</div>
				</nav>
          </div>
        </div>
        <div class="row elementiIgralec" id=splosno>
          <div class="row">
            <div class=col-9>
            <h5>Splošni podatki</h5>
						<table id="tabela" class="table table-bordered table-striped">
							<tr>
								<td>Ime ekipe</td>
								<td><?php echo $ekipa['imeEkipe']; ?><br></td>
							</tr>
							<tr>
								<td>Trener</td>
								<td><?php echo $trener ?></td>
							</tr>
							<tr>
								<td>Pomočnik 1</td>
								<td><?php echo $pom1; ?></td>
							</tr>
							<tr>
								<td>Pomočnik 2</td>
								<td><?php echo $pom2; ?></td>
							</tr>
							<tr>
								<td><?php echo "<a href=Urejanje_ekipe.php?id=" . $idEkipe . " >Uredi</a>"; ?></td>
								<td>Izbriši</td>
							</tr>
						</table>
            </div>
            <div class=col>
            <h5>Prihajajoči treningi</h5>
						<table id="tabela" class="table table-bordered table-striped">
						<tr>
						<th>Naslov</th>
						<th>Datum</th>
						<th>Lokacija</th>
						</tr>
						<?php echo $prihajTreningi?>
						</table>
            </div>
          </div>
        </div>
        <div class="row elementiIgralec" id=igralci>
		<div class=col>
			<table id="tabela" class="table table-bordered table-striped">
				<tr>
                 <th scope="col">Ime in priimek</th>
                 <th scope="col">Datum rojstva</th>
                 <th scope="col">Email</th>
                 <th scope="col">Telefon</th>
                 <th scope="col">Opombe</th>
               </tr>
			   <?php echo $table; ?>
			</table>
			</div>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>