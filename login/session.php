<?php
   include('config.php');
   session_start();
   header('Content-Type: text/html; charset=ISO-8859-1');

   $user_check = $_SESSION['login_user'];

   $ses_sql = mysqli_query($db,"select `email`  from uporabniki where `email` = '$user_check' ");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session = $row['username'];

   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>
