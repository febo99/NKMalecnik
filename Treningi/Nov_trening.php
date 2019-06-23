<?php
include "../login/config.php";
session_start();
$sql = "SELECT * FROM ekipe";
$get=mysqli_query($db,$sql);
if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
  header("location: ../index.php");
}
$option = "";
while($row = mysqli_fetch_assoc($get)){
  $option .= '<option value = '. $row['ID'] .'>'.$row['imeEkipe'].'</option>';
}
$sqlL = "SELECT * FROM lokacije";
$getL=mysqli_query($db,$sqlL);
$optionL = "";
while($rowL = mysqli_fetch_assoc($getL)){
  $optionL .= '<option value = '. $rowL['ID'] .'>'.$rowL['ime'].'</option>';
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
<script src="../script.js"></script>
<script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
 
</head>
<body onload="setDate()">
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
       <h1>Nov trening</h1>
	  </div>
	<div class="col colGlava">
	</div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
        <div class="col-11 col-sm-11 order-sm-1  colKavarna novIgralec">
    		<form id="novTrening" action="Dodaj_trening.php" method="post" enctype="multipart/form-data">
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
              <span class="input-group-text" id="inputGroup-sizing-sm">Datum *</span>
            </div>
            <input type="date" class="form-control" id="datumTrening" name="datumTrening" value=dd.mm.lll>
          </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">Ura *</span>
            </div>
            <input type="time" class="form-control" name="uraTreninga" required>
          </div>
          </div>
            <div class="row">
              <div class="input-group mb-3">
              <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">Trajanje(min) *</span>
            </div>
            <input min=1 max=180 type="number" class="form-control" id="trajanje" name="trajanje" required>
            <button type="button" onclick="set60()" class="btn " >60</button>
            <button type="button" onclick="set90()"class="btn " >90</button>
            <button type="button" onclick="set120()"class="btn" >120</button>
          </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">Lokacija*</span>
            </div>
              <select required class="form-control" name="lokacijaTrening">
                <option value="" disabled selected>Izberi lokacijo!</option>
                <?php echo $optionL; ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">Naslov *</span>
            </div>
            <input type="text" class="form-control"  name="naslovTrening" placeholder="Kratek naslov treninga">
          </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <input type="file" class="form-control-file" name=priponka id="priponka" accept=".doc,.docx,.pdf,.png,.jpg" >
            </div>
          </div>
        <button type="submit" class="btn btn-primary btnForma">Dodaj</button>
        <button type="reset" class="btn btn-danger btnForma">Prekliči</button>
      </form>



    </div>

  </div>
</body>
</html>
