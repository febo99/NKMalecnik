<?php
include "login/config.php";
session_start();
if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
  header("location: index.php");
}
$sql = "SELECT * FROM ekipe";
$get=mysqli_query($db,$sql);
$option = "";
$idIgralca = $_GET['id'];
$sqlI = "SELECT * FROM igralci WHERE `ID` = '$idIgralca'";
$query = mysqli_query($db,$sqlI);
$igralec = mysqli_fetch_assoc($query);
while($row = mysqli_fetch_assoc($get)){
  if($row['ID'] == $igralec['ekipaID'])$option .= '<option selected value = '. $row['ID'] .'>'.$row['imeEkipe'].'</option>';
  else
  $option .= '<option value = '. $row['ID'] .'>'.$row['imeEkipe'].'</option>';
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
<link rel="stylesheet" href="fixed-left.css">
<link rel="stylesheet" href="style.css">
<script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
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
              <a class="nav-link sub-link" href="Tekme/Nova_tekma.php">Nova tekma</a>
            </li>
            <li>
              <a class="nav-link sub-link" href="Tekme/Moje_tekme.php">Moje tekme</a>
            </li>
            <li>
              <a class="nav-link sub-link" href="Tekme/Vse_tekme.php">Vse tekme</a>
            </li>
          </ul>
        </li>
        </li>
        <li class="nav-item">
                <li class="nav-item dropdown">
                    <a href="#akcijaSub" class="nav-link dropdown-toggle" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">Delovne akcije</a>
                      <ul class="collapse list-unstyled" id="akcijaSub">
                        <li>
                            <a class="nav-link sub-link" href="Delovne_akcije/Clani.php">Člani</a>
                        </li>
                        <li>
                            <a class="nav-link sub-link" href="Delovne_akcije/Nova_akcija.php">Nova akcija</a>
                        </li>
                        <li>
                            <a class="nav-link sub-link" href="Delovne_akcije/Delovne_akcije.php">Delovne akcije</a>
                        </li>
                  </ul>
              </li>
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
    <div class="row glava"><!--GLAVA-->
      <div class="col-11 colGlava">
       <h1>Uredi igralca <?php echo $igralec['ime'] . " " . $igralec['priimek']?></h1>
	  </div>
	<div class="col colGlava">
	</div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
        <div class="col-11 col-sm-11 order-sm-1  colKavarna novIgralec">
        <h2>Splošno</h2>
    		<form id="novIgralecSplosno" action="./Ureditev_igralca.php" method="post">
            <input type="hidden" name="idIgralca" value=<?php echo $igralec['ID'];?>>
          <div class="col">
            <div class="row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ekipa*</span>
              </div>
                <select required class="form-control" name="ekipa"  >
                  <?php echo $option; ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ime*</span>
              </div>
        				<input type="text" class="form-control" name="ime" placeholder="Janez" value=<?php echo $igralec['ime'];?> required>
        			</div>
              </div>

            <div class="row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Priimek*</span>
              </div>
              <input type="text" class="form-control" name="priimek" value=<?php echo $igralec['priimek'];?> required>
            </div>
            </div>

            <div class="row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Datum rojstva*</span>
              </div>
              <input type="date" class="form-control" name="datumRojstva" value=<?php echo $igralec['datumRojstva'];?> required>
            </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Letnik rojstva</span>
              </div>
              <input type="int" class="form-control" name="letnik" value=<?php echo $igralec['letnik'];?> pattern={4}>
            </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Ulica*</span>
              </div>
              <input type="text" class="form-control" name="ulica" value="<?php echo $igralec['ulica'];?>" required>
            </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Poštna številka*</span>
                </div>
                <input type="number" class="form-control" name="postnaStevilka" value=<?php echo $igralec['postnaStevilka'];?> pattern={4} required>
              </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Mesto*</span>
                </div>
                <input type="text" class="form-control" name="mesto" value=<?php echo $igralec['mesto'];?> required>
              </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Šola</span>
                </div>
                <input type="text" class="form-control" name="sola" value="<?php echo $igralec['sola'];?>">
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
                  <input type="tel" class="form-control" name="telefonIgralec" value=<?php echo $igralec['telefonIgralec'];?> pattern="+[0-9]{3}[0-9]{8}">
                </div>
                </div>

              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Email igralec</span>
                </div>
                <input type="email" class="form-control" name="emailIgralec" value=<?php echo $igralec['emailIgralec'];?>>
              </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Starš 1*</span>
                </div>
                <input type="text" class="form-control" name="nazivStars1" value="<?php echo $igralec['nazivStars1'];?>" required>
              </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Starš 1 telefon*</span>
                </div>
                <input type="tel" class="form-control" name="telefonStars1" value="<?php echo $igralec['telefonStars1'];?>" pattern="+[0-9]{3}[0-9]{8}" required>
              </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Starš 1 email*</span>
                </div>
                <input type="email" class="form-control" name="emailStars1" value="<?php echo $igralec['emailStars1'];?>" required>
              </div>
              </div>

              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Starš 2</span>
                </div>
                <input type="text" class="form-control" name="nazivStars2" value="<?php echo $igralec['nazivStars2'];?>">
              </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Starš 2 telefon</span>
                </div>
                <input type="tel" class="form-control" name="telefonStars2" value="<?php echo $igralec['telefonStars2'];?>" pattern="+[0-9]{3}[0-9]{8}">
              </div>
              </div>
              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Starš 2 email</span>
                </div>
                <input type="email" class="form-control" name="emailStars2"value="<?php echo $igralec['emailStars2'];?>">
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
              <input type="number" class="form-control" name="emso" value=<?php echo $igralec['emso'];?> pattern="{13}">
            </div>
            </div>

          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">Registracijska št.</span>
            </div>
            <input type="number" class="form-control" name="registracijskaStevilka" value=<?php echo $igralec['registracijskaStevilka'];?>>
          </div>
          </div>

          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">Opombe</span>
            </div>
            <textarea class="form-control" name="opombe" rows="3" id="opombe" value="<?php echo $igralec['opombe'];?>"></textarea>
            </div>
          </div>
        </div>
        <button type="submit" onclick=""class="btn btn-primary btnForma">Uredi</button>
        <button type="reset" class="btn btn-danger btnForma">Prekliči</button>
      </form>



    </div>

  </div>
</body>
</html>
