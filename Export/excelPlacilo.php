<?php
include "../login/config.php";
include 'xlsxwriter.class.php';
$filename = "placilo.xlsx";
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

    $query="SELECT * FROM placilnaLista INNER JOIN igralci ON placilnaLista.igralecID = igralci.ID WHERE placilnaLista.statusPlacila = 1 ";
    $result = mysqli_query($db,$query);
    //$rows = mysqli_fetch_assoc($result);
    $header = array(
      'Ime'=>'string',
      'Priimek'=>'string',
      'Ulica'=>'string',
      'Pošta'=>'string',
	  'Mesto'=>'string',
	  'Mesec'=>'string',

    );
    $writer = new XLSXWriter();
        $writer->writeSheetHeader('Podatki', $header,$col_options = ['widths'=>[10,20,20,10,20,20], 'suppress_row'=>false]);
        $array = array();
        while ($row=$result->fetch_assoc())
        {
            $array[0] = $row['ime'];
            $array[1] = $row['priimek'];
            $array[2] = $row['ulica'];
            $array[3] = $row['postnaStevilka'];
			$array[4] = $row['mesto'];
			if($row['mesec'] == 1)$array[5] = 'Januar';
			else if($row['mesec'] == 2)$array[5] = 'Februar';
			else if($row['mesec'] == 3)$array[5] = 'Marec';
			else if($row['mesec'] == 4)$array[5] = 'April';
			else if($row['mesec'] == 5)$array[5] = 'Maj';
			else if($row['mesec'] == 6)$array[5] = 'Junij';
			else if($row['mesec'] == 7)$array[5] = 'Julij';
			else if($row['mesec'] == 8)$array[5] = 'Avgust';
			else if($row['mesec'] == 9)$array[5] = 'September';
			else if($row['mesec'] == 10)$array[5] = 'Oktober';
			else if($row['mesec'] == 11)$array[5] = 'November';
			else if($row['mesec'] == 12)$array[5] = 'December';
            $writer->writeSheetRow('Podatki', $array);
        };
        $writer->writeToStdOut();
        exit(0);
