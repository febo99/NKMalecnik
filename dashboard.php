<?php
include('login/session.php');
include('login/config.php');
session_start();
header('Content-Type: text/html; charset=UTF-8');
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
<link rel="stylesheet" href="fixed-left.css">
<link rel="stylesheet" href="style.css">
<script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-left">
    <a class="navbar-brand" href="">NK MALEČNIK</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Domov</a>
            </li>
            <div class="dropdown-divider"></div>
            <li class="nav-item">
                <a class="nav-link"href="Moji_igralci/Moji_igralci.php">Moji igralci</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"href="Vsi_igralci/Vsi_igralci.php">Vsi igralci</a>
			</li>
			<li class="nav-item">
                <a class="nav-link"href="Ekipe/Ekipe.php">Ekipe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"href="">Obvestilo</a>
			</li>

      <div class="dropdown-divider"></div>
			<!-- NOVA KATEGORIJA -->
            <li class="nav-item">
                <a class="nav-link"href="Koledar/Koledar.php">Koledar</a>
			</li>
            <li class="nav-item">
              <li class="nav-item dropdown">
                  <a href="#treningiSub" class="nav-link dropdown-toggle" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">Treningi</a>
                    <ul class="collapse list-unstyled" id="treningiSub">
                      <li>
                          <a class="nav-link sub-link" href="Treningi/Nov_trening.php">Nov trening</a>
                      </li>
                      <li>
                          <a class="nav-link sub-link" href="Treningi/Moji_treningi.php">Moji treningi</a>
                      </li>
                      <li>
                          <a class="nav-link sub-link" href="Treningi/Vsi_treningi.php">Vsi treningi</a>
                      </li>
                      <li>
                          <a class="nav-link sub-link" href="#">Predloge treningov</a>
                      </li>
                </ul>
            </li>
            </li>
            <li class="nav-item">
              <li class="nav-item dropdown">
                  <a href="#tekmeSub" class="nav-link dropdown-toggle" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">Tekme</a>
                    <ul class="collapse list-unstyled" id="tekmeSub">
                      <li>
                          <a class="nav-link sub-link" href="#">Nova tekma</a>
                      </li>
                      <li>
                          <a class="nav-link sub-link" href="#">Moje tekme</a>
                      </li>
                      <li>
                          <a class="nav-link sub-link" href="#">Vse tekme</a>
                      </li>
                </ul>
            </li>
            </li>
            <li class="nav-item">
                <a class="nav-link"href="">Zdravstveni karton</a>
			</li>
      <div class="dropdown-divider"></div>
			<li class="nav-item">
                <a class="nav-link"href="">Poročilo prisotnosti</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"href="">Testiranja</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"href="">Skavting</a>
			</li>
			<li class="nav-item">
                <a class="nav-link"href="">Video analiza</a>
            </li>
        <div class="dropdown-divider"></div>
        <li class="nav-item">
              <a class="nav-link"href="Uporabniki/Uporabniki.php">Uporabniki</a>
        </li>
              <li class="nav-item dropdown">
                  <a href="#nastavitveSub" class="nav-link dropdown-toggle" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">Nastavitve</a>
                    <ul class="collapse list-unstyled" id="nastavitveSub">
                      <li>
                          <a class="nav-link sub-link" href="#">Podatki kluba</a>
                      </li>
                      <li>
                          <a class="nav-link sub-link" href="#">Prestavi igralce</a>
                      </li>
                      <li>
                          <a class="nav-link sub-link" href="#">Lokacije treningov</a>
                      </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
	<div id="container">
    <div class="row glava"><!--GLAVA-->
      <div class="col colGlava">
	  <h1><?php echo $_SESSION['name']. " " . $_SESSION['last_name']; ?></h1> <!-- IME iz php session-->
        <h2 class="text-light-op"><?php echo $_SESSION['vloga']; ?></h2>
      </div>
    </div>
    <div class="row kavarna"><!--KAVARNA-->
      <div class="col colKavarna">
        yočđžš
      </div>
    </div>
	</div>

</body>
</html>