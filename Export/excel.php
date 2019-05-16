<?php
include "../login/config.php";
include 'xlsxwriter.class.php';
$filename = "vsiIgralci.xlsx";
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

    $id = $_SESSION['id'];
    $query="SELECT * FROM igralci";
    $result = mysqli_query($db,$query);
    //$rows = mysqli_fetch_assoc($result);
    $header = array(
      'Ime'=>'string',
      'Priimek'=>'string',
      'Datum rojstva'=>'date',
      'Letnik'=>'integer',
      'Ulica'=>'string',
      'Pošta'=>'string',
      'Mesto'=>'string',
      'Šola'=>'string',
      'Email'=>'string',
      'Telefon'=>'string',
      'Emšo'=>'string',
      'Registracija'=>'string',
      'Opombe'=>'string',
      'Ekipa'=>'string',
      'Starš 1'=>'string',
      'Telefon starš 1'=>'string',
      'Email starš 1'=>'string',
      'Starš 2'=>'string',
      'Telefon starš 2'=>'string',
      'Email starš 2'=>'string',

    );
    $writer = new XLSXWriter();
        $writer->writeSheetHeader('Sheet1', $header,$col_options = ['widths'=>[10,20,20,10,20,20,20,20,20,20,40,30,30,30,30,30,30,30,30,30], 'suppress_row'=>false]);
        $array = array();
        while ($row=$result->fetch_assoc())
        {
            $idEkipe = $row['ekipaID'];
            $sqlIme = "SELECT `imeEkipe` FROM ekipe WHERE `ID` = '$idEkipe'";
            $getIme = mysqli_query($db,$sqlIme);
            $imeEkipe = mysqli_fetch_row($getIme);
            $array[0] = $row['ime'];
            $array[1] = $row['priimek'];
            $array[2] = $row['datumRojstva'];
            $array[3] = $row['letnik'];
            $array[4] = $row['ulica'];
            $array[5] = $row['postnaStevilka'];
            $array[6] = $row['mesto'];
            $array[7] = $row['sola'];
            $array[8] = $row['emailIgralec'];
            $array[9] = $row['telefonIgralec'];
            $array[10] = $row['emso'];
            $array[11] = $row['registracijskaStevilka'];
            $array[12] = $row['opombe'];
            $array[13] = $imeEkipe[0];
            $array[14] = $row['nazivStars1'];
            $array[15] = $row['telefonStars1'];
            $array[16] = $row['emailStars1'];
            $array[17] = $row['nazivStars2'];
            $array[18] = $row['telefonStars2'];
            $array[19] = $row['emailStars2'];
            $writer->writeSheetRow('Sheet1', $array);
        };
        $writer->writeToStdOut();
        exit(0);
