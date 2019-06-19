<?php
include "../login/config.php";
session_start();
$sql = "SELECT * FROM ekipe";
$get = mysqli_query($db, $sql);
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
  header("location: ../index.php");
}
$option = "";
while ($row = mysqli_fetch_assoc($get)) {
  $option .= '<option value = ' . $row['ID'] . '>' . $row['imeEkipe'] . '</option>';
}
$sqlL = "SELECT * FROM lokacije";
$getL = mysqli_query($db, $sqlL);
$optionL = "";
while ($rowL = mysqli_fetch_assoc($getL)) {
  $optionL .= '<option value = ' . $rowL['ID'] . '>' . $rowL['ime'] . '</option>';
}
?>

<html style="background-color: rgb(60, 68, 77);">

<head>
  <title>NK Malecnik</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../fixed-left.css">
  <link rel="stylesheet" href="../style.css">
  <script src="../script.js"></script>
  <script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.js"></script>
</head>

<body onload="setDate()">
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
      <div class="col-11 colGlava">
        <h1>Nova tekma</h1>
      </div>
      <div class="col colGlava">
      </div>
    </div>
    <div class="row kavarna">
      <!--KAVARNA-->
      <div class="col-11 col-sm-11 order-sm-1  colKavarna novIgralec">
        <form id="novTrening" action="Dodaj_trening.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGrup-sizing-sm">Tip*</span>
              </div>
              <select required class="form-control" name="tipTekme">
                <option value="1" selected>Liga</option>
                <option value="2" selected>Pokal</option>
                <option value="3" selected>Prijateljska</option>
                <option value="4" selected>Turnir</option>
              </select>

            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGrup-sizing-sm">Lokacija*</>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" checked=checked name="domaGost" id="inlineRadio1" value="1">
                <label class="form-check-label" for="inlineRadio1" >Doma</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="domaGost" id="inlineRadio2" value="2">
                <label class="form-check-label" for="inlineRadio2">V gosteh</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ekipa*</span>
              </div>
              <select required class="form-control" name="ekipa" placeholder="Izberi ekipo">
                <option value="" disabled selected>Izberi ekipo!</option>
                <?php echo $option; ?>
              </select>
              <input type="number" class="form-control" name="domaciGoli" placeholder="Št. golov">
            </div>
          </div>

          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nasprotnik *</span>
              </div>
              <input type="text" class="form-control" name="nasprotnik" placeholder="Ime nasprotnika">
              <input type="number" class="form-control" name="nasprotnikGoli" placeholder="Št. golov">
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Datum *</span>
              </div>
              <input type="date" class="form-control" id="datumTrening" name="datumTrening" value=dd.mm.lll>
            </div>

          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ura tekme *</span>
              </div>
              <input type="time" class="form-control" name="uraTreninga" required>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Zbor *</span>
              </div>
              <input type="time" class="form-control" name="uraZbora" required>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ime lokacije *</span>
              </div>
              <input type="text" class="form-control" name="lokacija" placeholder="Kraj tekme">
            </div>
          </div>
          <button type="submit" class="btn btn-primary btnForma">Dodaj</button>
          <button type="reset" class="btn btn-danger btnForma">Prekliči</button>
        </form>



      </div>

    </div>
</body>

</html>