<?php
include "../login/config.php";
session_start();
$idTekme = $_GET['id'];
$sql = "SELECT * FROM ekipe";
$get = mysqli_query($db, $sql);
$sqlTekma = "SELECT * FROM tekme WHERE `ID` = '$idTekme'";
$queryTekma = mysqli_query($db,$sqlTekma);
$tekma = mysqli_fetch_assoc($queryTekma);
$ch1 = "";
$ch2 = $sel1 = $sel2 = $sel3 = $sel4 =  "";
if($tekma['lokacija'] == 1)$ch1 = "checked";
else $ch2 = "checked";
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
  header("location: ../index.php");
}
$option = "";
while ($row = mysqli_fetch_assoc($get)) {
	if($row['ID'] == $tekma['ekipaID']){
		$option .= '<option selected value = ' . $row['ID'] . '>' . $row['imeEkipe'] . '</option>';
	}else{
		$option .= '<option value = ' . $row['ID'] . '>' . $row['imeEkipe'] . '</option>';
	}
}
if($tekma['tip'] == 1)$sel1 = "selected";
else if($tekma['tip'] == 2)$sel2 = "selected";
else if($tekma['tip'] == 3)$sel3 = "selected";
else if($tekma['tip'] == 4)$sel4 = "selected";
$sqlL = "SELECT * FROM lokacije";
$getL = mysqli_query($db, $sqlL);
$optionL = "";
while ($rowL = mysqli_fetch_assoc($getL)) {
	if($rowL['ID'] == $tekma['lokacijaID']){
		$optionL .= '<option selected value = ' . $rowL['ID'] . '>' . $rowL['ime'] . '</option>';
	}else{
  		$optionL .= '<option value = ' . $rowL['ID'] . '>' . $rowL['ime'] . '</option>';
	}
}
?>

<html style="background-color: rgb(60, 68, 77);" lang="sl">

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

<body onload="displayLokacija()">
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
        <h1>Urejanje tekme</h1>
      </div>
      <div class="col colGlava">
      </div>
    </div>
    <div class="row kavarna">
      <!--KAVARNA-->
      <div class="col-11 col-sm-11 order-sm-1  colKavarna novIgralec">
        <form id="novTrening" action="Uredi_tekmo.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name=idTekme value=<?php echo $idTekme?>>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGrup-sizing-sm">Tip*</span>
              </div>
              <select required class="form-control" name="tipTekme">
                <option value="1" <?php echo $sel1;?> >Liga</option>
                <option value="2" <?php echo $sel2;?>>Pokal</option>
                <option value="3" <?php echo $sel3;?>>Prijateljska</option>
                <option value="4" <?php echo $sel4;?>>Turnir</option>
              </select>

            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGrup-sizing-sm">Lokacija*</>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" <?php echo $ch1 ?> name="domaGost" id="inlineRadio1" value="1" onclick=vnosLokacije(this)>
                <label class="form-check-label" for="inlineRadio1" >Doma</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"<?php echo $ch2 ?>  name="domaGost" id="inlineRadio2" value="2" onclick=vnosLokacije(this)>
                <label class="form-check-label" for="inlineRadio2">V gosteh</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ekipa*</span>
              </div>
              <select required class="form-control" name="ekipa" >
                <?php echo $option; ?>
              </select>
              <input type="number" class="form-control"  value=<?php echo $tekma['golDomaci'];?> name="domaciGoli" placeholder="Št. golov">
            </div>
          </div>

          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Nasprotnik *</span>
              </div>
              <input type="text" class="form-control" name="nasprotnik" value=<?php echo $tekma['nasprotnik'];?> placeholder="Ime nasprotnika">
              <input type="number" class="form-control" value=<?php echo $tekma['golGosti'];?> name="nasprotnikGoli" placeholder="Št. golov">
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Datum *</span>
              </div>
              <input type="date" class="form-control"  name="datumTekme" value=<?php echo $tekma['datum'];?>>
            </div>

          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ura tekme *</span>
              </div>
              <input type="time" class="form-control" name="uraTekme" id="uraTekma" value=<?php echo $tekma['uraTekme'];?> required>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Zbor *</span>
              </div>
              <input type="time" class="form-control" name="uraZbora" id="uraZbor" value=<?php echo $tekma['uraZbora'];?> required>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ime lokacije *</span>
              </div>
              <input type="text" class="form-control" id="gLokacija" value="<?php echo $tekma['imeLokacije'];?>" name="lokacija" placeholder="Kraj tekme">
              <select class="form-control" id="dLokacija" name="domacaLokacija">
                <?php echo $optionL; ?>
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btnForma">Shrani</button>
        </form>



      </div>

    </div>
</body>

</html>