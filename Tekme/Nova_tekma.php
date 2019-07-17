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

<html lang="sl">

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
      <div class="row" style="margin-top:0.5vh;margin-left:1vh;">
        <form id="novTrening" action="Dodaj_tekmo.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGrup-sizing-sm">Tip*</span>
              </div>
              <select required class="form-control" name="tipTekme">
                <option value="1" selected>Liga</option>
                <option value="2">Pokal</option>
                <option value="3" >Prijateljska</option>
                <option value="4" >Turnir</option>
              </select>

            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGrup-sizing-sm">Lokacija*</>
              </div>
              <div class="form-check form-check-inline" style="margin-left:0.5vh">
                <input class="form-check-input" type="radio" checked=checked name="domaGost" id="inlineRadio1" value="1" onclick=vnosLokacije(this)>
                <label class="form-check-label" for="inlineRadio1" >Doma</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="domaGost" id="inlineRadio2" value="2" onclick=vnosLokacije(this)>
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
              <input type="number" class="form-control"  value=0 name="domaciGoli" placeholder="Št. golov">
            </div>
          </div>

          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nasprotnik *</span>
              </div>
              <input type="text" class="form-control" name="nasprotnik" placeholder="Ime nasprotnika">
              <input type="number" class="form-control" value=0 name="nasprotnikGoli" placeholder="Št. golov">
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Datum *</span>
              </div>
              <input type="date" class="form-control" id="datumTrening" name="datumTekme">
            </div>

          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ura tekme *</span>
              </div>
              <input type="time" class="form-control" name="uraTekme" id="uraTekma" value=16:00 required>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Zbor *</span>
              </div>
              <input type="time" class="form-control" name="uraZbora" id="uraZbor" value=15:00 required>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ime lokacije *</span>
              </div>
              <input type="text" class="form-control" id="gLokacija"name="lokacija" placeholder="Kraj tekme">
              <select class="form-control" id="dLokacija" name="domacaLokacija">
                <option value="" disabled selected>Izberi lokacijo!</option>
                <?php echo $optionL; ?>
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btnForma">Dodaj</button>
          <button type="reset" class="btn btn-danger btnForma">Prekliči</button>
        </form>
    </div>
        </div>

    </div>
</body>

</html>