<?php
include "../login/config.php";
session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	$stevec = 1;
     foreach ($_POST as $param_name => $param_val) {
		 if($stevec % 2 != 0)$ekipa = $param_val;
		 else{
			$igralec = $param_val;
			echo $ekipa . " " . $igralec . "\n";
			$sql = "UPDATE igralci SET `ekipaID` = '$ekipa' WHERE `ID` = '$igralec'";
			mysqli_query($db,$sql);
		 } 
		 $stevec++;
		
	}
	header("location:Ekipe.php");
}
?>