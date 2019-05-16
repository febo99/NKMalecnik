<?php
include "../login/config.php";
session_start();
$sql = "SELECT * FROM ekipe";
$get=mysqli_query($db,$sql);
$option = "";
while($row = mysqli_fetch_assoc($get)){
  $option .= '<option value = '. $row['ID'] .'>'.$row['imeEkipe'].'</option>';
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
<script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.js"></script>
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
    <div class="row glava"><!--GLAVA-->
      <div class="col-11 colGlava">
       <h1>Nov igralec</h1>
	  </div>
	<div class="col colGlava">
	</div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
        <div class="col-11 col-sm-11 order-sm-1  colKavarna novIgralec">
        <h2>Splošno</h2>
    		<form id="novIgralecSplosno" action="./Dodaj_igralca.php" method="post">
          <div class="col">
            <div class="row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ekipa*</span>
              </div>
                <select required class="form-control" name="ekipa" placeholder="Izberi ekipo">
                  <option value="" disabled selected>Izberi ekipo!</option>
                  <?php echo $option; ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ime*</span>
              </div>
        				<input type="text" class="form-control" name="ime" placeholder="Janez" required>
        			</div>
              </div>

            <div class="row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Priimek*</span>
              </div>
              <input type="text" class="form-control" name="priimek" placeholder="Novak" required>
            </div>
            </div>

            <div class="row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Datum rojstva*</span>
              </div>
              <input type="date" class="form-control" name="datumRojstva" placeholder="24.03.1999" required>
            </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Letnik rojstva</span>
              </div>
              <input type="int" class="form-control" name="letnik" placeholder="1999" pattern={4}>
            </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ulica*</span>
              </div>
              <input type="text" class="form-control" name="ulica" placeholder="Malecnik 112" required>
            </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Poštna številka*</span>
                </div>
                <input type="number" class="form-control" name="postnaStevilka" placeholder="2229" pattern={4} required>
              </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Mesto*</span>
                </div>
                <input type="text" class="form-control" name="mesto" placeholder="Malečnik" required>
              </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Šola</span>
                </div>
                <input type="text" class="form-control" name="sola" placeholder="OŠ Malečnik" >
              </div>
            </div>
        </div>
        </div>
        <div class=" col-11 col-sm-11  order-sm-2  colKavarna novIgralec">
          <h2>Kontaktni podatki</h2>
            <div class="col">
              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Telefon igralec</span>
                </div>
                  <input type="tel" class="form-control" name="telefonIgralec" placeholder="+38651112112" pattern="+[0-9]{3}[0-9]{8}">
                </div>
                </div>

              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Email igralec</span>
                </div>
                <input type="email" class="form-control" name="emailIgralec" placeholder="jnovak@nkmalecnik.si">
              </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Starš 1*</span>
                </div>
                <input type="text" class="form-control" name="nazivStars1" placeholder="Zvonko Novak" required>
              </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Starš 1 telefon*</span>
                </div>
                <input type="tel" class="form-control" name="telefonStars1" placeholder="+38651113113" pattern="+[0-9]{3}[0-9]{8}" required>
              </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Starš 1 email*</span>
                </div>
                <input type="email" class="form-control" name="emailStars1" placeholder="znovak@nkmalecnik.si" required>
              </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Starš 2</span>
                </div>
                <input type="text" class="form-control" name="nazivStars2" placeholder="Marija Novak">
              </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Starš 2 telefon</span>
                </div>
                <input type="tel" class="form-control" name="telefonStars2" placeholder="+38651114114" pattern="+[0-9]{3}[0-9]{8}">
              </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Starš 2 email</span>
                </div>
                <input type="email" class="form-control" name="emailStars2" placeholder="mnovak@nkmalecnik.si">
              </div>
              </div>
              </div>
        </div>
      <div class="col-11 col-sm-11 order-sm-3   colKavarna novIgralec">
        <div class="col">
          <h2>Ostali podatki</h2>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">EMŠO</span>
            </div>
              <input type="number" class="form-control" name="emso" placeholder="0101006500001" pattern="{13}">
            </div>
            </div>

          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">Registracijska št.</span>
            </div>
            <input type="number" class="form-control" name="registracijskaStevilka" placeholder="000000">
          </div>
          </div>

          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">Opombe</span>
            </div>
            <textarea class="form-control" name="opombe" rows="3" id="opombe"></textarea>
            </div>
          </div>
        </div>
        <button type="submit" onclick=""class="btn btn-primary btnForma">Dodaj</button>
        <button type="reset" class="btn btn-danger btnForma">Prekliči</button>
      </form>



    </div>

  </div>
</body>
</html>