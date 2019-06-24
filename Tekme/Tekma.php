<?php
  include "../login/config.php";
  session_start();
  if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("location: ../index.php");
  }
  $id = $_SESSION['id'];
  $idTekme = $_GET['id'];
  $sql = "SELECT * FROM tekme WHERE `ID` = '$idTekme'";
  $get=mysqli_query($db,$sql);
  $row = mysqli_fetch_assoc($get);
  $table = "";
  $idEkipe = $row['ekipaID'];
  $sqlIme = "SELECT `imeEkipe` FROM ekipe WHERE `ID` = '$idEkipe'";
  $getIme = mysqli_query($db,$sqlIme);
  $imeEkipe = mysqli_fetch_row($getIme)[0];
  $sqlPrisotni = "SELECT * FROM prisotnostTekme  WHERE `tekmaID` = '$idTekme'";
  $getPrisotni = mysqli_query($db,$sqlPrisotni);
  $stvseh = mysqli_num_rows($getPrisotni);
  $sqlNeprisotni = "SELECT * FROM prisotnostTekme WHERE `prisotnost` != 1 AND `tekmaID` = '$idTekme'";
  $getNo = mysqli_query($db,$sqlNeprisotni);
  $prisotni = $stvseh - mysqli_num_rows($getNo);
  $procent = ($prisotni*100)/$stvseh;
  $tipTekme = "";
  $domGost = "";
  if(!empty($row['priponka']))$priponka = $row['priponka'];
  if($row['tip'] == 1)$tipTekme = "Liga";
  else if($row['tip'] == 2)$tipTekme = "Pokal";
  else if($row['tip'] == 3)$tipTekme = "Prijateljska";
  else if($row['tip'] == 4)$tipTekme = "Turnir";
  if($row['lokacija'] == 1)$domGost = "domača";
  else $domGost = "gostujoča";
  while($rowD = mysqli_fetch_assoc($getPrisotni)){
    $idIgralca = $rowD['igralecID'];
    $sqlImeI = "SELECT * FROM igralci WHERE `ID` = '$idIgralca'";
    $getImeI = mysqli_query($db,$sqlImeI);
    $imepriimek = mysqli_fetch_assoc($getImeI);
    $imepriimekText = $imepriimek['ime']. " ".$imepriimek["priimek"];
    if($rowD['prisotnost'] == 1){
      $prisotnost = "✔️";
    }
    else if($rowD['prisotnost'] == 0){
      $prisotnost = "❌";
    }
    else if($rowD['prisotnost'] == 2){
      $prisotnost = "❌";
    }
    $table .= "<tr><td><a href=../Igralec.php?igralec=".$idIgralca.">".$imepriimekText."</a></td><td>".$prisotnost."</td></tr>";
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
<script src="../script.js"></script>
<link rel="stylesheet" href="../fixed-left.css">
<link rel="stylesheet" href="../style.css">
<script src="../script.js"></script>
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
      <div class="col-9 colGlava">
       <h3 style="margin-top:2vh;"><?php echo $imeEkipe . "-" . $row['nasprotnik'];?></h3>
       <h5>Prisotnost:<?php echo $prisotni."/".$stvseh;?></h5>
       <h5><?php echo $row['golDomaci'] . ":" . $row['golGosti'];?>   </h5>
	  </div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
      <div class="col colKavarna">
        <div class="row" style="margin-top:0.5vh;margin-left:1vh;">
          <div class="col-9">
            <h2>Prisotnost</h2>
            
          </div>
          <div class="col-1">
            <form name="exportExcel" action="../Export/excelM.php" method="post">
              <!--<input type="submit" name="export" class="btn btn-secondary" value="Excel">-->
            </form>
          </div>
        </div>
        <div class="col-8">
        <div class="table-responsive">
            <h5>Splošni podatki</h5>
          <table  class="table table-bordered table-striped">        
           <tbody>
            <tr><td>Tekma</td><td><?php echo $imeEkipe . "-" . $row['nasprotnik'];?></td></tr>
            <tr><td>Tip</td><td><?php echo $tipTekme . ", " . $domGost;?></td></tr>
            <tr><td>Datum in čas</td><td><?php echo date("d.m.Y", strtotime($row['datum'])) . " ". $row['uraTekme'];?></td></tr>
            <tr><td>Zbor</td><td><?php echo $row['uraZbora'];?></td></tr>
            <tr><td>Lokacija</td><td><?php echo $row['imeLokacije'];?></td></tr>
            <tr><td>Rezultat</td><td><?php echo "<b>".$row['golDomaci'] . "</b>:" . $row['golGosti'];?></td></tr>
            <tr><td><?php echo "<a href=Urejanje_tekme.php?id=".$idTekme.">Uredi</a>"?></td><td></td></tr>
            </tbody>
          </table>
      </div>
    </div>  
        <div class="col-8">
        <div class="table-responsive">
        <h5>Prisotnost</h5>
        <input type="text" id="iskanje" class="form-control" onkeyup="isciE()" placeholder="Iskanje...">
          <table id="tabela" class="table table-bordered table-striped">
            <thead>
               <tr>
                 <th scope="col-3">Igralec</th>
                 <th scope="col-7">Prisotnost</th>
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
	</div>
</div>
</body>
</html>
