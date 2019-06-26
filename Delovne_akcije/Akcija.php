<?php
  include "../login/config.php";
  session_start();
  if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("location: ../index.php");
  }
  $ime = "";
  $id = $_SESSION['id'];
  $idAkcije = $_GET['id'];
  $sql = "SELECT * FROM delovneAkcije WHERE `ID` = '$idAkcije'";
  $akcija = mysqli_fetch_assoc(mysqli_query($db,$sql));
  $table = "";

    $sql = "SELECT * FROM prisotnostAkcije INNER JOIN delovneAkcije ON  prisotnostAkcije.akcijaID = delovneAkcije.ID  WHERE prisotnostAkcije.akcijaID = '$idAkcije'";
    $query = mysqli_query($db,$sql);
    while($row = mysqli_fetch_assoc($query)){
        $idClan = $row['clanID'];
        $sqlClan = "SELECT * FROM clani WHERE `ID` = '$idClan'";
        $queryClan = mysqli_query($db,$sqlClan);
        $clan = mysqli_fetch_assoc($queryClan);
        if($row['prisotnost'] == 1){
			if($_SESSION['vloga'] == 1 || $_SESSION['vloga'] == 2 )$table .= "<tr><td><a href=Clan.php?id=".$idClan.">".$clan['ime']." ".$clan['priimek']."</a></td><td>✔️</td></tr>";
          	else $table .= "<tr><td>".$clan['ime']." ".$clan['priimek']."</td><td>✔️</td></tr>";
        }
        else{
				if($_SESSION['vloga'] == 1 || $_SESSION['vloga'] == 2 )$table .= "<tr><td><a href=Clan.php?id=".$idClan.">".$clan['ime']." ".$clan['priimek']."</a></td><td>❌</td></tr>";
				else $table .= "<tr><td>".$clan['ime']." ".$clan['priimek']."</td><td>❌</td></tr>";
			}
	  }
	  $sqlPrisotni = "SELECT * FROM prisotnostAkcije WHERE `akcijaID` = '$idAkcije'";
	  $getPrisotni = mysqli_query($db, $sqlPrisotni);
	  $stvseh = mysqli_num_rows($getPrisotni);
	  $sqlNeprisotni = "SELECT * FROM prisotnostAkcije WHERE `prisotnost` != 1 AND `akcijaID` = '$idAkcije'";
	  $getNo = mysqli_query($db,$sqlNeprisotni);
	  $prisotni = $stvseh - mysqli_num_rows($getNo);
	  $procent = round(($prisotni*100)/$stvseh,2);
	  $igralciSQL = "SELECT * FROM clani";
	  $getIgralci = mysqli_query($db, $igralciSQL);
	  $beseda .= "<span id='" . $idAkcije . "' style='display:none;'><form action='prisotnost.php' method='post' ><input type='hidden' name='treningID' value=" . $idAkcije . ">";

				while ($row = mysqli_fetch_assoc($getIgralci)) {
					$forma = '<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="customRadioInline1" name="prisotnost" class="custom-control-input" value=1>
					<label class="custom-control-label" for="customRadioInline1">Prisoten</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="customRadioInline2" name="prisotnost" class="custom-control-input" value=2>
					<label class="custom-control-label" for="customRadioInline2">Manjkal</label>
					</div>';
					$idClan = $row['ID'];
					$sqlT = "SELECT prisotnost FROM prisotnostAkcije WHERE `clanID` = '$idClan' AND `akcijaID` = '$idAkcije'";
					$prisotnost = mysqli_fetch_assoc(mysqli_query($db,$sqlT));
					$dodatno = "prisotnost" . $row['ID'] . $idAkcije;
					if($prisotnost['prisotnost'] == 1){
						$dodatnoide = 'customRadioInline1' . $row['ID'] . $idAkcije . '" checked ';
						$dodatnoidd = 'customRadioInline2' . $row['ID'] . $idAkcije;
						$forma = str_replace("prisotnost", $dodatno, $forma);
						$forma = str_replace("customRadioInline1", $dodatnoide, $forma);
						$forma = str_replace("customRadioInline2", $dodatnoidd, $forma);
						
					}else if($prisotnost['prisotnost'] == 2){
						$dodatnoide = 'customRadioInline1' . $row['ID'] . $idAkcije;
						$dodatnoidd = 'customRadioInline2' . $row['ID'] . $idAkcije . '" checked ';
						$forma = str_replace("prisotnost", $dodatno, $forma);
						$forma = str_replace("customRadioInline1", $dodatnoide, $forma);
						$forma = str_replace("customRadioInline2", $dodatnoidd, $forma);
						
					}
					$beseda .= "<h5>" . $row['ime'] . " " . $row['priimek'] . "</h5>" . $forma . "<br>";
				}
				$beseda .= '<button type="submit"  class="btn btn-primary zapri">Shrani</button>
				<button type="reset" class="btn btn-secondary zapri" data-dismiss="modal">Prekliči</button></form></span>';

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
       <h3 style="margin-top:2vh;"><?php echo $akcija['naslov'];?></h3>
	   <?php echo $akcija['datum']. ", " . $akcija['zacetek'] . "<br>Število ur: " . $akcija['ure'];?>
	  </div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
      <div class="col colKavarna">
        <div class="col-8">
        <div class="table-responsive">
        <h5>Prisotni</h5>
        <input type="text" id="iskanje" class="form-control" onkeyup="isciE()" placeholder="Iskanje...">
          <table id="tabela" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th scope="col">Ime in priimek</th>
                <th scope="col">Prisotnost</th>
            </tr>
           </thead>
           <tbody>
             <?php
			echo $table;
			  ?>
			<tr><td><a href="Urejanje_akcije.php?id=<?php echo $idAkcije;?>">Uredi</td><td><button type=button class='btn btn-primary priso'  data-toggle=modal  value="<?php if($_SESSION['vloga'] == 1 ||$_SESSION['vloga'] == 2)echo $idAkcije?>" data-target=#vnosPrisotnosti>Urejanje prisotnosti</td></tr>
            </tbody>
          </table>
      </div>
		<div class="col">
		<h5>Poročilo</h5>
		<?php echo $akcija['porocilo'];?>
		</div>

    </div>

    </div>

	</div>

</div>
</body>
</html>
