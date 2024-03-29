<?php
include "../login/config.php";
session_start();
if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    header("location: dashboard.php");
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
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm"></div>
		<div class="col-sm">
			<h1>Dobrodošli nazaj!</h1>
			<form method="post" action="login/login.php" >
				<div class="form-group">
					<label for="inputUporabnik">Email</label>
					<input type="text" class="form-control" name="inputUporabnik" id="inputUporabnik" placeholder="Vnesi uporabniško ime" autofocus>
				</div>
				<div class="form-group">
					<label for="inputGeslo">Geslo</label>
					<input type="password" class="form-control" name="gesloUporabnik" id="gesloUporabnik" placeholder="Geslo">
				</div>
				<button type="submit" class="btn btn-primary">Prijava</button>
			</form>
		</div>
		<div class="col-sm"></div>
	</div>
</body>
</html>
