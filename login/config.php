<?php
define("SERVER", "localhost");
define("USER", "root");
define("PWD","rdecastrela6");
define("DB", "NKMalecnik");
$db = mysqli_connect(SERVER, USER, PWD, DB);
$db->set_charset("utf8")
?>
