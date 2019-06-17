<?php
include('login/session.php');
include "../login/config.php";
session_start();
//header('Content-Type: text/html; charset=UTF-8');
if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
  header("location: ../index.php");
}
$sql = "SELECT * FROM ekipe";
$get=mysqli_query($db,$sql);
$option = "";
while($row = mysqli_fetch_assoc($get)){
  $option .= '<option value = '. $row['ID'] .'>'.$row['imeEkipe'].'</option>';
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

<link rel="stylesheet" href="/Web2Cal/css/Web2Cal.css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.js"></script>
<script src="/Web2Cal/Web2Cal-3.0.min.js" type="text/javascript"></script>
<script src="/Web2Cal/Web2Cal.support.js" type="text/javascript"></script>
<script src="/Web2Cal/Web2Cal.templates.js" type="text/javascript"></script>

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
      <div class="col colGlava">
        <h1>Poročilo prisotnosti</h1>
      </div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
      <div class="col colKavarna">
        <div class="col-2">
            <select id="ekipa" required class="form-control" name="ekipa" placeholder="Izberi ekipo">
              <option value="" disabled selected>Izberi ekipo!</option>
              <?php echo $option; ?>
            </select>
              <input id="datumTrening" name="datum" value="<?=date('Y-m')?>" type="month">
              <button type="submit" onclick="getJson()">🔎</button>
			  </div>
        </div>

        <div class="table-responsive">
          <table id="tabela" class="table table-bordered">
            <thead>
               <tr class="stat">
                 <th class="def" scope="col">Igralec</th>
                 <th class="def" scope="col">Vsi</th>
                 <th class="def" scope="col">✔️</th>
                 <th class="def" scope="col">❌</th>
               </tr>
           </thead>
           <tbody>

            </tbody>
          </table>
      </div>
      </div>
      </div>
    </div>

</body>
</html>
