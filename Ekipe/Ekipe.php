<?php
include('../login/session.php');
include('../login/config.php');
session_start();
header('Content-Type: text/html; charset=UTF-8');
$sql = "SELECT * FROM ekipe";
if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
  header("location: ../index.php");
}
$get=mysqli_query($db,$sql);
$table = "";
while($row = mysqli_fetch_assoc($get)){
  $trenerID = $row['trenerID'];
  $sqlIme = "SELECT `ime`,`priimek` FROM uporabniki WHERE `ID` = '$trenerID'";
  $getIme = mysqli_query($db,$sqlIme);
  $array = mysqli_fetch_row($getIme);
  $imeTrener = $array[0];
  $priimekTrener = $array[1];
  $table .= "<tr><td>".$row['imeEkipe']."</td>"."<td>".$imeTrener." ".$priimekTrener. "</td></tr>";
}
?>

<html>
<head>
<title>NK Malecnik</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
     <h1>Ekipe</h1>
  </div>
<div class="col-2 colGlava divNovGumb">
    <button type="button"  class="btn btn-primary btn-md btn-block gumbNov" onclick="location.href='Nova_ekipa.php'">Dodaj ekipo</button>
    <button type="button"  class="btn btn-secondary btn-md btn-block gumbNov" >Neaktivni igralci</button>
</div>
  </div>
  <div class="row kavarna"><!--KAVARNA-->
    <div class="col colKavarna">
      <div class="row" style="margin-top:0.5vh;margin-left:1vh;">
        <div class="col-10">
          <input type="text" id="iskanje" class="form-control" onkeyup="isciE()" placeholder="Iskanje ekip...">
        </div>
      </div>
      <div class="table-responsive">
        <table id="tabela" class="table table-bordered">
          <thead>
             <tr>
               <th scope="col">Ime ekipe</th>
               <th scope="col">Trener</th>
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
