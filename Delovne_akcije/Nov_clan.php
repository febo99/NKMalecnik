<?php
include "../login/config.php";
session_start();
if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
  header("location: ../index.php");
}

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
 <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../fixed-left.css">
<link rel="stylesheet" href="../style.css">
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
    <div class="row glava"><!--GLAVA-->
      <div class="col-11 colGlava">
       <h1>Nov član</h1>
	  </div>
	<div class="col colGlava">
	</div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
        <div class="col-11 col-sm-11 order-sm-1  colKavarna novIgralec">
        <h2>Osnovni podatki</h2>
    		<form id="novIgralecSplosno" action="Dodaj_clana.php" method="post">
          <div class="col">
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
                  <span class="input-group-text" id="inputGroup-sizing-sm">Telefon</span>
                </div>
                  <input type="tel" class="form-control" name="telefon" placeholder="+38651112112" pattern="+[0-9]{3}[0-9]{8}">
                </div>
                </div>

              <div class="row">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                </div>
                <input type="email" class="form-control" name="email" placeholder="jnovak@nkmalecnik.si">
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
