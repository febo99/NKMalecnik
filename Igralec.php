<?php
  include "login/config.php";
  session_start();
  if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("location: ../index.php");
  }
  $id = $_SESSION['id'];
  $idIgralec = $_GET['igralec'];
  $sqlIgralec = "SELECT igralci.ime,igralci.priimek,ekipe.imeEkipe FROM igralci  INNER JOIN ekipe ON igralci.ekipaID = ekipe.ID WHERE igralci.ID = '$idIgralec'";
  $queryIgralec = mysqli_query($db,$sqlIgralec);
  $igralec = mysqli_fetch_array($queryIgralec);
 ?>

<html>
<head>
<title>NK Malecnik</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="../script.js"></script>
<link rel="stylesheet" href="fixed-left.css">
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.js"></script>
</head>
<body>
  <div id="nav-placeholder">
    <script>
  $(function(){
    $("#nav-placeholder").load("nav.html");
  });
  </script>
  </div>
	<div id="container">
    <div class="row glava"><!--GLAVA-->
      <div class="col-9 colGlava">
       <h3 style="margin-top:2vh;"><?php echo $igralec[0]." ".$igralec[1];#izpis imena in priimka?></h3>
       <h5><?php echo $igralec[2];?>
	  </div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
      <div class="col colKavarna">
      <div class="row">
          <div class="col">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-item nav-link active" href="#">Splošno <span class="sr-only">(current)</span></a>
                  <a class="nav-item nav-link" href="#">Treningi</a>
                  <a class="nav-item nav-link" href="#">Tekme</a>
                </div>
              </div>
            </nav>
          </div>
        </div>
        <div class="row" id=splosno>
          <div class=col-6>
            Splošni podatki
            <div class=row>
              <div class=col-4>
                Prisotnost zadnjih 10 treningov
              </div>
              <div class=col-4>
                Prisotnost zadnjih 10 tekem
              </div>
            </div>
            <div class=row>
              <div class=col-4>
                Ime in priimek<br>
                Datum rojstva<br>
                Ulica<br>
                Mesto in poštna številka
              </div>
              <div class=col-4>
                Ime in priimek<br>
                Datum rojstva<br>
                Ulica<br>
                Mesto in poštna številka
              </div>
            </div>
            <div class=row>
              <div class="col-4">
                Uredi
              </div>
              <div class="col-4">
                Izbriši
              </div>
            </div>
            </div>
            <div class=col-6>
              Ostali podatki
            </div>
          </div>
        </div>
        <div class="row" id=treningi>
          <div class=col-6>
            a
          </div>
          <div class=col-6>
            a
          </div>
        </div>
        <div class="row" id=tekme>
          <div class=col-6>
            c
          </div>
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
