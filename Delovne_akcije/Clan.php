<?php
  include "../login/config.php";
  session_start();
  if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("location: ../index.php");
  }
  $ime = "";
  $id = $_SESSION['id'];
  $idClan = $_GET['id'];
  $sql = "SELECT * FROM clani WHERE `ID` = '$idClan'";
  $clan = mysqli_fetch_assoc(mysqli_query($db,$sql));
  $table = "";
  if($_SESSION['vloga'] == 1){
    $sql = "SELECT * FROM prisotnostAkcije INNER JOIN clani ON  prisotnostAkcije.clanID = clani.ID  WHERE prisotnostAkcije.clanID = '$idClan' AND prisotnostAkcije.prisotnost = 1";
    $query = mysqli_query($db,$sql);
    while($row = mysqli_fetch_assoc($query)){
        $idAkcije = $row['akcijaID'];
        $sqlAkcija = "SELECT * FROM delovneAkcije WHERE `ID` = '$idAkcije' ";
        $queryAkcija = mysqli_query($db,$sqlAkcija);
        $akcija = mysqli_fetch_assoc($queryAkcija);
        if($row['prisotnost'] == 1){
          $table .= "<tr><td><a href=Akcija.php?id=".$idAkcije.">".$akcija['naslov']."</a></td><td>".$akcija['datum'].", ".$akcija['zacetek']."-".$akcija['konec']."<td>".$akcija['ure']."</<td></td><td>✔️</td></tr>";
        }
          else{
          $table .= "<tr><td><a href=Akcija.php?id=".$idAkcije.">".$akcija['naslov']."</a></td><td>".$akcija['datum'].", ".$akcija['zacetek']."-".$akcija['konec']."<td>".$akcija['ure']."</td></td><td>❌</td></tr>";
      }
    }
    $sqlMesec = "SELECT * FROM prisotnostAkcije INNER JOIN clani ON  prisotnostAkcije.clanID = clani.ID  WHERE prisotnostAkcije.clanID = '$idClan' AND prisotnostAkcije.prisotnost = 1";
  }else{
    header("Location:Clani.php");
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
       <h3 style="margin-top:2vh;"><?php echo $clan['ime'] . " " . $clan['priimek'];?></h3>
	  </div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
      <div class="col colKavarna">
        <div class="col">
        <div class="table-responsive">
        <h5>Delovne akcije</h5>
        <input type="text" id="iskanje" class="form-control" onkeyup="isciE()" placeholder="Iskanje...">
          <table id="tabela" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th scope="col">Naslov</th>
                <th scope="col">Datum</th>
                <th scope="col">Število ur</th>
                <th scope="col">Prisotnost</th>
            </tr>
           </thead>
           <tbody>
             <?php
            echo $table;
              ?>
              
            </tbody>
          </table>
          <h4><a href="Urejanje_clana.php?id=<?php echo $idClan?>">Urejanje člana</a></h4>
      </div>
      <input id="datumAkcija" name="datum" value="<?=date('Y-m')?>" type="month">
      <button type="submit" onclick="poMesecih(<?php echo $idClan?>)">🔎</button>
      <h3>Stevilo ur v mesecu <span id="mesec"></span>: <span id="steviloUr"></span></h3>
    </div>

    </div>
	</div>
</div>
</body>
</html>
