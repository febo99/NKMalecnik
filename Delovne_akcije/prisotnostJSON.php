<?php
include "../login/config.php";
session_start();
header("Content-type: application/json; charset=utf-8");
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("location: ../index.php");
}
$akcije = array();
$sql = "SELECT * FROM prisotnostAkcije INNER JOIN delovneAkcije ON  prisotnostAkcije.akcijaID = delovneAkcije.ID ";
$query = mysqli_query($db,$sql);
while($row = mysqli_fetch_assoc($query)){
	$akcija = array();
	$akcija['id'] = $row['clanID'];
	$akcija['datum'] = $row['datum'];
	$akcija['ure'] = $row['ure'];
	array_push($akcije,$akcija);
}
//array_push($eventi,$stevilo);
//testiranje
echo json_encode($akcije,JSON_UNESCAPED_UNICODE);
exit();
?>
