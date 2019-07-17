<?php
include "../login/config.php";
session_start();
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
  header("location: ../index.php");
}
$id = $_SESSION['id'];
$idTreninga = $_GET['id'];
$sql = "SELECT * FROM treningi WHERE `ID` = '$idTreninga'";

$get = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($get);
if(empty($row))header("Location: Vsi_treningi.php");
if ($row['ustvaril'] == $_SESSION['id'] || $_SESSION['vloga'] == 1) {
  $uDel = $row['uvod'];
  $zDel = $row['zakljucek'];
  $gDel = $row['glavni'];
  $porocilo = $row['porocilo'];
  $table = "";
  $idEkipe = $row['ekipaID'];
  $sqlIme = "SELECT `imeEkipe` FROM ekipe WHERE `ID` = '$idEkipe'";
  $getIme = mysqli_query($db, $sqlIme);
  $imeEkipe = mysqli_fetch_row($getIme)[0];
  $sqlPrisotni = "SELECT * FROM prisotnost WHERE `treningID` = '$idTreninga'";
  $getPrisotni = mysqli_query($db, $sqlPrisotni);
  $stvseh = mysqli_num_rows($getPrisotni);
  $sqlNeprisotni = "SELECT * FROM prisotnost WHERE `prisotnost` != 1 AND `treningID` = '$idTreninga'";
  $getNo = mysqli_query($db,$sqlNeprisotni);
  $prisotni = $stvseh - mysqli_num_rows($getNo);
  $procent = round(($prisotni*100)/$stvseh,2);
  $igralciSQL = "SELECT * FROM igralci WHERE `ekipaID` = '$idEkipe'";
  $getIgralci = mysqli_query($db, $igralciSQL);
  $beseda .= "<span id='" . $idTreninga . "' style='display:none;'><form action='prisotnost.php' method='post' ><input type='hidden' name='treningID' value=" . $idTreninga . ">";

  while ($row = mysqli_fetch_assoc($getIgralci)) {
    $forma = '<div class="custom-control custom-radio custom-control-inline">
    <input type="radio" id="customRadioInlineI" name="prisotnost" class="custom-control-input" value=1>
    <label class="custom-control-label" for="customRadioInlineI">Prisoten</label>
  </div>
  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio" id="customRadioInlineD" name="prisotnost" class="custom-control-input" value=2>
    <label class="custom-control-label" for="customRadioInlineD">Opravicen</label>
  </div>
  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio" id="customRadioInlineT" name="prisotnost" class="custom-control-input" value=0>
    <label class="custom-control-label" for="customRadioInlineT">Neopravicen</label>
  </div>';
    $idIgralca = $row['ID'];
    $sqlPrisotnost = "SELECT * FROM prisotnost WHERE `igralecID` = '$idIgralca' AND `treningID` = '$idTreninga'";
    $queryP = mysqli_query($db,$sqlPrisotnost);
    $prisotnost = mysqli_fetch_assoc($queryP);
    $dodatno = "prisotnost" . $row['ID'] ."_". $idTreninga;
    if($prisotnost['prisotnost'] == 1){
      $dodatnoide = 'customRadioInlineI' . $row['ID'] ."_". $idTreninga . '" checked ';
      $dodatnoidd = "customRadioInlineD" . $row['ID'] ."_". $idTreninga;
      $dodatnoidt = "customRadioInlineT" . $row['ID'] ."_". $idTreninga;
      $forma = str_replace("prisotnost", $dodatno, $forma);
      $forma = str_replace("customRadioInlineI", $dodatnoide, $forma);
      $forma = str_replace("customRadioInlineD", $dodatnoidd, $forma);
      $forma = str_replace("customRadioInlineT", $dodatnoidt, $forma);
    }
    else if($prisotnost['prisotnost'] == 2){
      $dodatnoide = 'customRadioInlineI' . $row['ID'] ."_". $idTreninga;
      $dodatnoidd = 'customRadioInlineD' . $row['ID'] ."_". $idTreninga . '" checked ';
      $dodatnoidt = "customRadioInlineT" . $row['ID'] ."_". $idTreninga;
      $forma = str_replace("prisotnost", $dodatno, $forma);
      $forma = str_replace("customRadioInlineI", $dodatnoide, $forma);
      $forma = str_replace("customRadioInlineD", $dodatnoidd, $forma);
      $forma = str_replace("customRadioInlineT", $dodatnoidt, $forma);
    }
    else if($prisotnost['prisotnost'] == 0){
      $dodatnoide = 'customRadioInlineI' . $row['ID'] ."_". $idTreninga;
      $dodatnoidd = "customRadioInlineD" . $row['ID'] ."_". $idTreninga;
      $dodatnoidt = 'customRadioInlineT' . $row['ID'] ."_". $idTreninga . '" checked ';
      $forma = str_replace("prisotnost", $dodatno, $forma);
      $forma = str_replace("customRadioInlineI", $dodatnoide, $forma);
      $forma = str_replace("customRadioInlineD", $dodatnoidd, $forma);
      $forma = str_replace("customRadioInlineT", $dodatnoidt, $forma);
    }

    
    $beseda .= "<h5>" . $row['ime'] . " " . $row['priimek'] . "</h5>" . $forma . "<br>";
  }
  $beseda .= '          <button type="reset" class="btn btn-secondary zapri" data-dismiss="modal">Prekliči</button>
             <button type="submit"  class="btn btn-primary zapri">Shrani</button></form></span>';

  if (!empty($row['priponka'])) $priponka = $row['priponka'];

  while ($rowD = mysqli_fetch_assoc($getPrisotni)) {
    $idIgralca = $rowD['igralecID'];
    $sqlImeI = "SELECT * FROM igralci WHERE `ID` = '$idIgralca'";
    $getImeI = mysqli_query($db, $sqlImeI);
    $imepriimek = mysqli_fetch_assoc($getImeI);
    $imepriimekText = $imepriimek['ime'] . " " . $imepriimek["priimek"];
    if ($rowD['prisotnost'] == 1) {
      $prisotnost = "✔️";
    } else if ($rowD['prisotnost'] == 0) {
      $prisotnost = "❌";
    } else if ($rowD['prisotnost'] == 2) {
      $prisotnost = "⭕";
    }
    $table .= "<tr><td><a href=../Igralec.php?igralec=" . $idIgralca . ">" . $imepriimekText . "</a></td><td>" . $prisotnost . "</td></tr>";
  }
  $table .= "<tr><td><button type=button class='btn btn-primary priso'  data-toggle=modal  value='" . $idTreninga . "' data-target=#vnosPrisotnosti>Urejanje prisotnosti</td><td><form action=Brisi_trening.php method=post onsubmit=' return confirm(`Ste prepričani, da želite izbrisati željeno vsebino?`);'>
  <button class='btn btn-danger'>Briši</button>
  <input type=hidden name=treningID value='".$idTreninga."'>
</form></td></tr>";
} else {
  header("Location:Vsi_treningi.php");
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
  <script src="../script.js"></script>
  <link rel="stylesheet" href="../fixed-left.css">
  <link rel="stylesheet" href="../style.css">
  <script src="../script.js"></script>
  <script async="" defer="" src="https://buttons.github.io/buttons.js"></script>

</head>

<body>
  <div class="modal fade" id="vnosPrisotnosti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Prisotnost</h5>
          <button type="button" class="close zapri" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align:center;">

          <?php echo $beseda; ?>
        </div>
        <div class="modal-footer">

        </div>
        </form>
      </div>
    </div>
  </div>
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
        <h3 style="margin-top:2vh;"><?php echo $row['naslov']; ?></h3>
        <h5>Prisotnost:<?php echo $prisotni . "/" . $stvseh; ?></h5>
        <h5><?php echo $imeEkipe; ?>
      </div>
      <div class="col-2 colGlava divNovGumb">
        <form action="IzvoziPDF.php" method=post>
          <input type="hidden" name=treningID value=<?php echo $idTreninga?>>
          <button type="submit"  class="btn btn-primary btn-md btn-block gumbNov">Izvozi v PDF</button>
        </form>
			
	</div>
    </div>
    <div class="row kavarna">
      <!--KAVARNA-->
      <div class="col colKavarna">
        <div class="row" style="margin-top:0.5vh;margin-left:1vh;">
          <div class="col-9">
            <h2>Prisotnost</h2>
            <input type="text" id="iskanje" class="form-control" onkeyup="isciE()" placeholder="Iskanje po igralcu..">
          </div>
          <div class="col-1">
            <form name="exportExcel" action="../Export/excelM.php" method="post">
              <!--<input type="submit" name="export" class="btn btn-secondary" value="Excel">-->
            </form>
          </div>
        </div>
        <div class="col-8">
          <div class="table-responsive">
            <table id="tabela" class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col-3">Igralec</th>
                  <th scope="col-7">Prisotnost</th>
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
        <div class="col-9 planTreninga">
          <div class="col plan naslov">
            <h2>Plan</h2>
          </div>
          <div class="row" style="margin-top:0.5vh;margin-left:1vh;">
            <div class="col-5 plan vsebina">
              <h4>Uvodni del</h4>
              <p><?php echo $uDel; ?></p>
            </div>
          </div>
          <div class="row" style="margin-top:0.5vh;margin-left:1vh;">
            <div class="col-5 plan vsebina">
              <h4>Glavni del</h4>
              <p><?php echo $gDel; ?></p>
            </div>
          </div>
          <div class="row" style="margin-top:0.5vh;margin-left:1vh;">
            <div class="col-5 plan vsebina">
              <h4>Zaključni del</h4>
              <p><?php echo $zDel; ?></p>
            </div>
          </div>
          <div class="row" style="margin-top:0.5vh;margin-left:1vh;">
            <div class="col-5 plan vsebina">
              <h4>Poročilo</h4>
              <?php
              echo "<p>" . $porocilo . "</p>";
              if (!empty($row['priponka']))
                echo '<a href="/' . $priponka . '"target=_blank>Poročilo treninga</a>';
              ?>
            </div>
          </div>
          <?php echo "<a href=Urejanje_trening.php?id=".$idTreninga.">Uredi</a>"?>

        </div>
      </div>
    </div>
</body>

</html>