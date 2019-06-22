<?php
include('login/session.php');
include "../login/config.php";
session_start();
//header('Content-Type: text/html; charset=UTF-8');
$sql = "SELECT * FROM `uporabniki`";
$get=mysqli_query($db,$sql);
$table = "";
while($row = mysqli_fetch_assoc($get)){
  $table .= "<tr><td>".$row['email']."</td><td>".$row['ime']."</td><td>".$row['priimek']."</td><td>".$row['vloga']."</td></tr>";
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
      <div class="col colGlava">
        <h1>Uporabniki</h1>
      </div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
      <div class="col colKavarna">
        <div class="col-9">
          <input type="text" id="iskanje" class="form-control" onkeyup="isciP()" placeholder="Iskanje po priimku...">
        </div>
        <div class="col-2 colGlava divNovGumb">
          <button type="button"  class="btn btn-primary btn-md btn-block gumbNov" onclick="location.href='Nov_uporabnik.php'">Nov uporabnik</button>
        </div>
        <div class="table-responsive">
          <table id="tabela" class="table table-bordered">
            <thead>
               <tr>
                 <th scope="col">Email</th>
                 <th scope="col">Ime</th>
                 <th scope="col">Priimek</th>
                 <th scope="col">Vloga</th>
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

</body>
</html>
