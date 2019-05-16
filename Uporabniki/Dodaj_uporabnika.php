<?php
include "../login/config.php";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $email = mysqli_real_escape_string($db,$_POST['email']);
     $ime = mysqli_real_escape_string($db,$_POST['ime']);
     $priimek = mysqli_real_escape_string($db,$_POST['priimek']);
     $vloga = mysqli_real_escape_string($db,$_POST['vloga']);
     $geslo = mysqli_real_escape_string($db,$_POST['geslo']);
     $sql = "INSERT INTO uporabniki(email,ime,priimek,geslo,vloga) VALUES('$email','$ime','$priimek','$geslo','$vloga')";
     mysqli_query($db,$sql);
     header("location:Uporabniki.php");

}
