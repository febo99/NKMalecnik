<?php
include "../login/config.php";
session_start();
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
  header("location: ../index.php");
}
if($_SESSION['vloga'] != 1 && $_SESSION['vloga'] != 2 ){
  header("location: Delovne_akcije.php");
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
        <h1>Nova akcija</h1>
      </div>
      <div class="col colGlava">
      </div>
    </div>
    <div class="row kavarna">
      <!--KAVARNA-->
      <div class="col-11 col-sm-11 order-sm-1  colKavarna novIgralec">
        <form id="novTrening" action="Dodaj_akcijo.php" method="post" enctype="multipart/form-data">

          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Naslov akcije*</span>
              </div>
              <input type="text" class="form-control" name="naslov" placeholder="Košnja trave">
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Datum*</span>
              </div>
              <input type="date" class="form-control" id="datumTrening" name="datum" value=dd.mm.lll>
            </div>

          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Začetek*</span>
              </div>
              <input type="time" class="form-control" name="zacetek" id="zacetek" value=16:00 required>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Konec*</span>
              </div>
              <input type="time" class="form-control" name="konec" id="konec" value=17:00 required>
            </div>
          </div>
          <div class="row">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Poročilo*</span>
              </div>
              <textarea class="form-control" rows="5" name="porocilo" id=porocilo placeholder="Kratko poročilo o akciji"></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btnForma">Dodaj</button>
          <button type="reset" class="btn btn-danger btnForma">Prekliči</button>
        </form>



      </div>

    </div>
</body>

</html>