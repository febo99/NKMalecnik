<?php
include "../login/config.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ime = mysqli_real_escape_string($db, $_POST['ime']);
  $priimek = mysqli_real_escape_string($db, $_POST['priimek']);
  $telefon = mysqli_real_escape_string($db, $_POST['telefon']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $id = mysqli_real_escape_string($db, $_POST['id']);
    $sql = "UPDATE clani SET `ime` = '$ime',`priimek` = '$priimek',`email` = '$email',`telefon` = '$telefon' WHERE `ID` = '$id'";
    $d = mysqli_query($db,$sql);
    header("location:Clan.php?id=".$id);
}
?>