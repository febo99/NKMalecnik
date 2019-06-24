<?php
include "config.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // username and password sent from form
   $myusername = mysqli_real_escape_string($db, $_POST['inputUporabnik']);
   $mypassword = mysqli_real_escape_string($db, $_POST['gesloUporabnik']);

   $sql = "SELECT * FROM uporabniki WHERE `email` = '$myusername' and `geslo` = '$mypassword'";
   $result = mysqli_query($db, $sql);
   $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
   $name = $row['ime'];
   $lastName = $row['priimek'];
   $id = $row['ID'];
   $vlogaID = $row['vloga'];
   $sql2 = "SELECT * FROM `vloga` WHERE 'ID' = '$vlogaID'";
   $result2 = mysqli_query($db, $sql2);
   $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
   $vloga = $row2['vloga'];
   $count = mysqli_num_rows($result);

   // If result matched $myusername and $mypassword, table row must be 1 row
   //echo $count;
   //echo $myusername;
   if ($count == 1) {
      //session_register("myusername");
      $_SESSION['login_user'] = $myusername;
      $_SESSION['name'] = $name;
      $_SESSION['last_name'] = $lastName;
      $_SESSION['id'] = $id;
      $_SESSION['vloga'] = $vlogaID;
      header("location: ../dashboard.php");
   } else {
      $error = "Your Login Name or Password is invalid";
      echo $error;
   }
}
