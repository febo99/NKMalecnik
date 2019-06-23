<?php
include "login/config.php";
session_start();
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
  header("location: ../index.php");
}
$id = $_SESSION['id'];
$idIgralec = $_GET['igralec'];
$sqlIgralec = "SELECT * FROM igralci  INNER JOIN ekipe ON igralci.ekipaID = ekipe.ID WHERE igralci.ID = '$idIgralec'";
$queryIgralec = mysqli_query($db, $sqlIgralec);
$igralec = mysqli_fetch_array($queryIgralec);
$ime = $igralec[1] . " " . $igralec[2];

$sql = "SELECT * FROM treningi INNER JOIN prisotnost ON treningi.ID = prisotnost.treningID WHERE prisotnost.igralecID = '$idIgralec' ORDER BY treningi.datum DESC";
$query = mysqli_query($db,$sql);
$table = "";

while($row = mysqli_fetch_assoc($query)){
  $ekipaID = $row['ekipaID'];
  $sqlEkipa = "SELECT imeEkipe FROM ekipe WHERE `ID` = '$ekipaID'";
  $ekipaQ = mysqli_query($db,$sqlEkipa);
  $ekipa = mysqli_fetch_array($ekipaQ);
  if($row['prisotnost'] != 1)$table .= "<tr><td><a href=Treningi/Trening.php?id=".$row['treningID'].">".$row['naslov']."</a></td><td>".$row['datum']."</td><td>".$ekipa[0]."</td><td>❌</td></tr>";
  else $table .= "<tr><td><a href=Treningi/Trening.php?id=".$row['treningID'].">".$row['naslov']."</a></td><td>".$row['datum']."</td><td>".$ekipa[0]."</td><td>✔️</td></tr>";
  
}
?>
<html lang="sl">

<head>
  <title>NK Malecnik</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="script.js"></script>
  <link rel="stylesheet" href="fixed-left.css">
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
  <script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
   
  <script>
    $(document).ready(function() {
      $.getJSON("Porocilo_prisotnosti/Prisotnost.php", function(data) {
        var steviloVseh = 0;
        var prisotnost = 0;
        for (var i = 0; i < data.length; i++) {
          if (data[i]['ekipaID'] == <?php echo $igralec[21] ?>) {
            steviloVseh = data[i]['treningi'].length;
            if(steviloVseh > 10)steviloVseh = 10;
            for (var j = 0; j < steviloVseh; j++) {
              if (data[i]['treningi'][j]['prisotni'].includes("Admin1 Admin1")) {
                prisotnost++;
              }
            }
          }
        }
        document.getElementById("stTreningov").innerHTML = prisotnost + " / " + steviloVseh;
      });
    });
  </script>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-left">
    <a class="navbar-brand" href="">NK MALEČNIK</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href=".">Domov</a>
        </li>
        <div class="dropdown-divider"></div>
        <li class="nav-item">
          <a class="nav-link" href="Moji_igralci/Moji_igralci.php">Moji igralci</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Vsi_igralci/Vsi_igralci.php">Vsi igralci</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Ekipe/Ekipe.php">Ekipe</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Obvestilo</a>
        </li>

        <div class="dropdown-divider"></div>
        <!-- NOVA KATEGORIJA -->
        <li class="nav-item">
          <a class="nav-link" href="Koledar/Koledar.php">Koledar</a>
        </li>
        <li class="nav-item">
        <li class="nav-item dropdown">
          <a href="#treningiSub" class="nav-link dropdown-toggle" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">Treningi</a>
          <ul class="collapse list-unstyled" id="treningiSub">
            <li>
              <a class="nav-link sub-link" href="Treningi/Nov_trening.php">Nov trening</a>
            </li>
            <li>
              <a class="nav-link sub-link" href="Treningi/Moji_treningi.php">Moji treningi</a>
            </li>
            <li>
              <a class="nav-link sub-link" href="Treningi/Vsi_treningi.php">Vsi treningi</a>
            </li>
            <li>
              <a class="nav-link sub-link" href="#">Predloge treningov</a>
            </li>
          </ul>
        </li>
        </li>
        <li class="nav-item">
        <li class="nav-item dropdown">
          <a href="#tekmeSub" class="nav-link dropdown-toggle" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">Tekme</a>
          <ul class="collapse list-unstyled" id="tekmeSub">
            <li>
              <a class="nav-link sub-link" href="#">Nova tekma</a>
            </li>
            <li>
              <a class="nav-link sub-link" href="#">Moje tekme</a>
            </li>
            <li>
              <a class="nav-link sub-link" href="#">Vse tekme</a>
            </li>
          </ul>
        </li>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Zdravstveni karton</a>
        </li>
        <div class="dropdown-divider"></div>
        <li class="nav-item">
          <a class="nav-link" href="Porocilo_prisotnosti/Porocilo_prisotnosti.php">Poročilo prisotnosti</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Testiranja</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Skavting</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Video analiza</a>
        </li>
        <div class="dropdown-divider"></div>
        <li class="nav-item">
          <a class="nav-link" href="Uporabniki/Uporabniki.php">Uporabniki</a>
        </li>
        <li class="nav-item dropdown">
          <a href="#nastavitveSub" class="nav-link dropdown-toggle" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">Nastavitve</a>
          <ul class="collapse list-unstyled" id="nastavitveSub">
            <li>
              <a class="nav-link sub-link" href="#">Podatki kluba</a>
            </li>
            <li>
              <a class="nav-link sub-link" href="#">Prestavi igralce</a>
            </li>
            <li>
              <a class="nav-link sub-link" href="#">Lokacije treningov</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <div id="container">
    <div class="row glava">
      <!--GLAVA-->
      <div class="col-9 colGlava">
        <h3 style="margin-top:2vh;"><?php echo $ime; ?></h3>
        <h5><?php echo $igralec[23]; ?>
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
                  <a class="nav-item nav-link tt" href="#treningi">Treningi</a>
                  <a class="nav-item nav-link tt" href="#tekme">Tekme</a>
                </div>
              </div>
            </nav>
          </div>
        </div>
        <div class="row elementiIgralec" id=splosno>
          <div class="row">
            <div class=col>
            <h5>Splošni podatki</h5>
            <table id="tabela" class="table table-bordered table-striped">
            <tr><td>Prisotnost zadnjih 10 treningov</td><td><span id="stTreningov"></span><br></td></tr>
            <tr><td>Ime in priimek</td><td><?php echo $igralec[1] . " " . $igralec[2];?></td></tr>
            <tr><td>Datum rojstva</td><td><?php echo date("d.m.Y", strtotime($igralec[3]));?></td></tr>
            <tr><td>Ulica</td><td><?php echo $igralec[5];?></td></tr>
            <tr><td>Mesto in poštna številka</td><td><?php echo $igralec[6] . " " . $igralec[7];?></td></tr>
            <tr><td><?php echo "<a href=Uredi_igralca.php?id=".$idIgralec." >Uredi</a>" ;?></td><td>Izbriši</td></tr>
            </table>
            </div>
            <div class=col>
            <h5>Splošni podatki</h5>
            <table id="tabela" class="table table-bordered table-striped">
            <tr><td>Tel. igralec</td><td><?php echo $igralec[9];?><br></td></tr>
            <tr><td>Email igralec</td><td><?php echo $igralec[10];?></td></tr>
            <tr><td>Tel. stars</td><td><?php echo $igralec[12];?></td></tr>
            <tr><td>Tel. stars</td><td><?php echo $igralec[15];?></td></tr>
            <tr><td>Email stars</td><td><?php echo $igralec[13];?></td></tr>
            <tr><td>Email stars</td><td><?php echo $igralec[16];?></td></tr>
            <tr><td>Šola</td><td><?php echo $igralec[8];?></td></tr>
            <tr><td>EMŠO</td><td><?php echo $igralec[17];?></td></tr>
            <tr><td>Registracijska št</td><td><?php echo $igralec[18];?></td></tr>
            <tr><td>Opombe</td><td><?php echo $igralec[19];?></td></tr>
            </table>
            </div>
          </div>
        </div>
        <div class="row elementiIgralec" id=treningi>
          <div class=col-6>
          <table id="tabela" class="table table-bordered table-striped">
            <tr>
              <th>Trening</th>
              <th>Datum</th>
              <th>Ekipa</th>
              <th>Prisotnost</th>
            </tr>
            <?php echo $table;?>
          </table>
          </div>
        </div>
        <div class="row elementiIgralec" id=tekme>
          <div class=col-6>
            c
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</body>

</html>