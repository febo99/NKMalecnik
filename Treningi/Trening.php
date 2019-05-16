<?php
  include "../login/config.php";
  session_start();
  $id = $_SESSION['id'];
  $idTreninga = $_GET['id'];
  $sql = "SELECT * FROM treningi WHERE `ID` = '$idTreninga'";
  $get=mysqli_query($db,$sql);
  $row = mysqli_fetch_assoc($get);
  $table = "";
  $idEkipe = $row['ekipaID'];
  $sqlIme = "SELECT `imeEkipe` FROM ekipe WHERE `ID` = '$idEkipe'";
  $getIme = mysqli_query($db,$sqlIme);
  $imeEkipe = mysqli_fetch_row($getIme)[0];
  $sqlPrisotni = "SELECT * FROM prisotnost WHERE `treningID` = '$idTreninga'";
  $getPrisotni = mysqli_query($db,$sqlPrisotni);
  $stvseh = mysqli_num_rows($getPrisotni);
  $sqlNeprisotni = "SELECT * FROM prisotnost WHERE `prisotnost` != 1 AND `treningID` = '$idTreninga'";
  $getNo = mysqli_query($db,$sqlNeprisotni);
  $prisotni = $stvseh - mysqli_num_rows($getNo);
  $procent = ($prisotni*100)/$stvseh;
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
<link rel="stylesheet" href="../fixed-left.css">
<link rel="stylesheet" href="../style.css">
<script src="../script.js"></script>
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
      <div class="col-9 colGlava">
       <h3 style="margin-top:2vh;"><?php echo $row['naslov'];?></h3>
       <h5>Prisotnost:<?php echo $prisotni."/".$stvseh;?></h5>
       <h5><?php echo $imeEkipe;?>
	  </div>
	<div class="col-2 colGlava divNovGumb">
			<button type="button"  class="btn btn-primary btn-md btn-block gumbNov" onclick="location.href='Nov_trening.php'">Nov trening</button>
	</div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
      <div class="col colKavarna">
        <div class="row" style="margin-top:0.5vh;margin-left:1vh;">
          <div class="col-9">
            <input type="text" id="iskanje" class="form-control" onkeyup="isciE()" placeholder="Iskanje po naslovu..">
          </div>
          <div class="col-1">
            <form name="exportExcel" action="../Export/excelM.php" method="post">
              <!--<input type="submit" name="export" class="btn btn-secondary" value="Excel">-->
            </form>
          </div>
        </div>
        <div class="table-responsive">
          <table id="tabela" class="table table-bordered">
            <thead>
               <tr>
                 <th scope="col">Ime</th>
                 <th scope="col">Prisotnost</th>
               </tr>
           </thead>
           <tbody>
             <?php
            echo $table;
              ?>
            </tbody>
          </table>

      </div>
    </div>
	</div>

</body>
</html>
