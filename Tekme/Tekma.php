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
  if($row['ustvaril'] == $_SESSION['id'] || $_SESSION['vloga'] == 1){
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
        $prisotnost = "⭕";
      }
      $table .= "<tr><td><a href=../Igralec.php?igralec=".$idIgralca.">".$imepriimekText."</a></td><td>".$prisotnost."</td></tr>";
    }
  }else{
    header("Location:Vse_tekme.php");
  }

    $igralciSQL = "SELECT * FROM igralci WHERE `ekipaID` = '$idEkipe'";
    $getIgralci = mysqli_query($db, $igralciSQL);
    $beseda .= "<span id='" . $idTekme . "' style='display:none;'><form action='prisotnost.php' method='post' ><input type='hidden' name='treningID' value=" . $idTekme . ">";
  
    while ($rowC = mysqli_fetch_assoc($getIgralci)) {
      $idTekme = $_GET['id'];
      $forma = '<div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="customRadioInlineI" name="prisotnost" class="custom-control-input" value=1>
      <label class="custom-control-label" for="customRadioInlineI">Prisoten</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="customRadioInlineD" name="prisotnost" class="custom-control-input" value=2>
      <label class="custom-control-label" for="customRadioInlineD">Opravicen</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="customRadioInlineT" name="prisotnost" class="custom-control-input" value=0>
      <label class="custom-control-label" for="customRadioInlineT">Neopravicen</label>
    </div>';
      $idIgralca = $rowC['ID'];
      $sqlPrisotnost = "SELECT * FROM prisotnostTekme WHERE `igralecID` = '$idIgralca' AND `tekmaID` = '$idTekme'";
      $queryP = mysqli_query($db,$sqlPrisotnost);
      $prisotnost = mysqli_fetch_assoc($queryP);
      $dodatno = "prisotnost" . $rowC['ID'] ."_". $idTekme;
      if($prisotnost['prisotnost'] == 1){
        $dodatnoide = 'customRadioInlineI' . $rowC['ID'] ."_". $idTekme . '" checked ';
        $dodatnoidd = "customRadioInlineD" . $rowC['ID'] ."_". $idTekme;
        $dodatnoidt = "customRadioInlineT" . $rowC['ID'] ."_". $idTekme;
        $forma = str_replace("prisotnost", $dodatno, $forma);
        $forma = str_replace("customRadioInlineI", $dodatnoide, $forma);
        $forma = str_replace("customRadioInlineD", $dodatnoidd, $forma);
        $forma = str_replace("customRadioInlineT", $dodatnoidt, $forma);
      }
      else if($prisotnost['prisotnost'] == 2){
        $dodatnoide = 'customRadioInlineI' . $rowC['ID'] ."_". $idTekme;
        $dodatnoidd = 'customRadioInlineD' . $rowC['ID'] ."_". $idTekme . '" checked ';
        $dodatnoidt = "customRadioInlineT" . $rowC['ID'] ."_". $idTekme;
        $forma = str_replace("prisotnost", $dodatno, $forma);
        $forma = str_replace("customRadioInlineI", $dodatnoide, $forma);
        $forma = str_replace("customRadioInlineD", $dodatnoidd, $forma);
        $forma = str_replace("customRadioInlineT", $dodatnoidt, $forma);
      }
      else if($prisotnost['prisotnost'] == 0){
        $dodatnoide = 'customRadioInlineI' . $rowC['ID'] ."_". $idTekme;
        $dodatnoidd = "customRadioInlineD" . $rowC['ID'] ."_". $idTekme;
        $dodatnoidt = 'customRadioInlineT' . $rowC['ID'] ."_". $idTekme . '" checked ';
        $forma = str_replace("prisotnost", $dodatno, $forma);
        $forma = str_replace("customRadioInlineI", $dodatnoide, $forma);
        $forma = str_replace("customRadioInlineD", $dodatnoidd, $forma);
        $forma = str_replace("customRadioInlineT", $dodatnoidt, $forma);
      }
      $beseda .= "<h5>" . $rowC['ime'] . " " . $rowC['priimek'] . "</h5>" . $forma . "<br>";
    }
    $beseda .= '
    <button type="reset" class="btn btn-secondary zapri" data-dismiss="modal">Prekliči</button>
               <button type="submit"  class="btn btn-primary zapri">Shrani</button></form></span>';

    


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
<div class="modal fade" id="vnosPrisotnosti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Prisotnost</h5>
          <button type="button" class="close zapri" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align:center;">
          <?php echo $beseda; ?>
        </div>
        <div class="modal-footer">

        </div>
        </form>
      </div>
    </div>
  </div>
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
          <button type=button class='btn btn-primary priso'  data-toggle=modal  value="<?php if($_SESSION['vloga'] == 1 ||$_SESSION['vloga'] == 2)echo $idTekme?>" data-target=#vnosPrisotnosti>Urejanje prisotnosti
      </div>
    </div>

    </div>
	</div>
</div>
</body>
</html>
