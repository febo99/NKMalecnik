<?php
include "../login/config.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ime = mysqli_real_escape_string($db, $_POST['ime']);
  $priimek = mysqli_real_escape_string($db, $_POST['priimek']);
  $telefon = mysqli_real_escape_string($db, $_POST['telefon']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
    $sql = "INSERT INTO clani(ime,priimek,email,telefon) VALUES ('$ime','$priimek','$email','$telefon')";
    $d = mysqli_query($db,$sql);
    header("location:Clani.php");
}
?>