<?php
include "../login/config.php";
session_start();
$idPredloge = $_GET['id'];
$sql = "SELECT * FROM predlogeTreningov WHERE `ID` = '$idPredloge'";
$query = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($query);
$naslov = $row['naslov'];
$uvod = $row['uvod'];
$glavni = $row['glavni'];
$zakljucek = $row['zakljucek'];
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
       <h1>Urejanje predloge</h1>
	  </div>
	<div class="col colGlava">
	</div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
    <div class="row" style="margin-top:0.5vh;margin-left:1vh;">
        <div class="col-11 col-sm-11 order-sm-1  colKavarna novIgralec">
    		<form id="novTrening" action="Uredi_predlogo.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm">Naslov*</span>
			</div>
      <input type="text" class="form-control"  required name="naslov" value='<?php echo $naslov?>'>
      <input type="hidden" name=idPredloge value=<?php echo $idPredloge;?>>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Uvodni del</span>
              </div>
              <textarea class="form-control" rows="5" name="uvod" id=porocilo><?php echo $uvod?></textarea>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Glavni del</span>
              </div>
              <textarea class="form-control" rows="5" name="glavni" id=porocilo placeholder="Glavni del"><?php echo $glavni?></textarea>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Zaključni del</span>
              </div>
              <textarea class="form-control" rows="5" name="zakljucni" id=porocilo placeholder="Zaključni del"><?php echo $zakljucek?></textarea>
            </div>
          </div>
        <button type="submit" class="btn btn-primary btnForma">Shrani</button>
        <button type="reset" class="btn btn-danger btnForma">Prekliči</button>
      </form>


      </div>
    </div>

  </div>
</body>
</html>
