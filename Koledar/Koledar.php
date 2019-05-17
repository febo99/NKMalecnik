<?php
include('login/session.php');
include("../login/config.php");
session_start();
header('Content-Type: text/html; charset=UTF-8');
$sql = "SELECT * FROM lokacije";
$get = mysqli_query($db,$sql);
$lokacije = "";
while($row = mysqli_fetch_assoc($get)){
  $lokacije .= "<i class='fas fa-square lokacije' style='color:".$row['barva'].";'></i>".$row['ime'];
}
?>

<html>
<head>
<title>NK Malecnik</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../fixed-left.css">
<link rel="stylesheet" href="../style.css">
<script src="../script.js"></script>
<script src="koledar.js"></script>
<script async="" defer="" src="https://buttons.github.io/buttons.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.js"></script>
<link href='../fullcalendar/packages/core/main.css' rel='stylesheet' />
<link href='../fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
<link href='../fullcalendar/packages/timegrid/main.css' rel='stylesheet' />

<script src='../fullcalendar/pacakges/core/locales/sl.js'></script>
<script src='../fullcalendar/packages/core/main.js'></script>
<script src='../fullcalendar/packages/daygrid/main.js'></script>
<script src='../fullcalendar/packages/timegrid/main.js'></script>

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
        <h1>Koledar</h1>
      </div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
        <div class="col colKavarna">
          <div class="row">
            <div class="col lokacija">
                <?php echo $lokacije;?>
            </div>
        </div>
          <div id='calendar'></div>
        </div>
      </div>
    </div>
	</div>

</body>
</html>
