<?php
include "../login/config.php";
include("library/tcpdf.php");
header('Content-Type: text/html; charset=utf-8');
session_start();
$id = $_SESSION['id'];
$idTreninga = $_POST['treningID'];
$sql = "SELECT * FROM treningi WHERE `ID` = '$idTreninga'";
$get = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($get);
$naslov = $row['naslov'];
$uDel = $row['uvod'];
$zDel = $row['zakljucek'];
$gDel = $row['glavni'];
$porocilo = $row['porocilo'];
$datum = date("d.m.y", strtotime($row['datum']));
$table = "";
$idEkipe = $row['ekipaID'];
$sqlIme = "SELECT `imeEkipe` FROM ekipe WHERE `ID` = '$idEkipe'";
$getIme = mysqli_query($db, $sqlIme);
$imeEkipe = mysqli_fetch_row($getIme)[0];
$sqlPrisotni = "SELECT * FROM prisotnost WHERE `treningID` = '$idTreninga'";
$getPrisotni = mysqli_query($db, $sqlPrisotni);
$stvseh = mysqli_num_rows($getPrisotni);
$sqlNeprisotni = "SELECT * FROM prisotnost WHERE `prisotnost` != 1 AND `treningID` = '$idTreninga'";
$getNo = mysqli_query($db,$sqlNeprisotni);
$prisotni = $stvseh - mysqli_num_rows($getNo);
$procent = round(($prisotni*100)/$stvseh,2);
$igralciSQL = "SELECT * FROM igralci WHERE `ekipaID` = '$idEkipe'";
$getIgralci = mysqli_query($db, $igralciSQL);
$table = '<table border="1" cellpadding="1"><tr><td style="text-align:center" colspan="2">'. $prisotni . '/' .$stvseh .'</td></tr>';
while ($rowD = mysqli_fetch_assoc($getPrisotni)) {
    $idIgralca = $rowD['igralecID'];
    $sqlImeI = "SELECT * FROM igralci WHERE `ID` = '$idIgralca'";
    $getImeI = mysqli_query($db, $sqlImeI);
    $imepriimek = mysqli_fetch_assoc($getImeI);
    $imepriimekText = $imepriimek['ime'] . " " . $imepriimek["priimek"];
    if ($rowD['prisotnost'] == 1) {
      $prisotnost = "Prisoten";
    } else if ($rowD['prisotnost'] == 0) {
      $prisotnost = "Neopravicen";
    } else if ($rowD['prisotnost'] == 2) {
      $prisotnost = "Opravicen";
    }
    $table .= "<tr><td>". $imepriimekText . "</td><td>" . $prisotnost . "</td></tr>";
  }
class myPDF extends TCPDF{
	public function header(){
		$this->Image("download.png", 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('dejavusans', 'B',25,'',false);
		// Title
		$this->SetXY(30, 18);
		$this->Cell(0, 15, 'NK Malečnik', 0, false, 'L', 0, '', 0, false, 'M', 'M');
		$this->SetXY(150, 20);
		$this->SetFont('dejavusans', '',11,'',false);
		$this->Cell(0, 15, date("d.m.Y"), 0, false, 'L', 0, '', 0, false, 'M', 'M');
		$this->SetXY(150, 25);
		$this->Cell(0, 15, 'Malečnik 55 ', 0, false, 'L', 0, '', 0, false, 'M', 'M');
		$this->SetXY(150, 30);
		$this->Cell(0, 15, '2229 Malečnik ', 0, false, 'L', 0, '', 0, false, 'M', 'M');
	}
	public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Stran '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
	public function MultiRow($left, $right) {
        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0)
		$this->setCellPaddings(3, 3, 3, 3);
        $page_start = $this->getPage();
        $y_start = $this->GetY();

        // write the left cell
        $this->MultiCell(40, 0, $left, 1, '', 1, 2, '', '', true, 0);

        $page_end_1 = $this->getPage();
        $y_end_1 = $this->GetY();

        $this->setPage($page_start);

        // write the right cell
        $this->MultiCell(0, 0, $right, 1, '', 0, 1, $this->GetX() ,$y_start, true, 0);

        $page_end_2 = $this->getPage();
        $y_end_2 = $this->GetY();

        // set the new row position by case
        if (max($page_end_1,$page_end_2) == $page_start) {
            $ynew = max($y_end_1, $y_end_2);
        } elseif ($page_end_1 == $page_end_2) {
            $ynew = max($y_end_1, $y_end_2);
        } elseif ($page_end_1 > $page_end_2) {
            $ynew = $y_end_1;
        } else {
            $ynew = $y_end_2;
        }

        $this->setPage(max($page_end_1,$page_end_2));
        $this->SetXY($this->GetX(),$ynew);
    }
}
$pdf = new myPDF('p','mm','A4',true,'UTF-8',false);
$pdf->SetTitle(str_replace(" ","_",$naslov).  "-" . $datum. ".pdf");
$pdf->setCellPadding(0);
$pdf->AddPage();
$pdf->SetFont('dejavusans', 'B',35,'',false);
$pdf->SetXY(40, 60);
$pdf->Cell(0, 15, 'Poročilo treninga ', 0, false, 'L', 0, '', 0, false, 'M', 'M');
$pdf->SetXY(50, 70);
$pdf->SetFont('dejavusans', '',12,'',false);
$pdf->Cell(0, 15, $naslov.', ' .$datum, 0, false, 'L', 0, '', 0, false, 'M', 'M');
$pdf->SetXY(10, 90);
$pdf->SetFillColor(255, 255, 200);
$pdf->MultiRow("Porocilo",$porocilo);
$pdf->MultiRow("Uvod",$uDel);
$pdf->MultiRow("Glavni del",$gDel);
$pdf->MultiRow("Zaključek",$zDel);
$pdf->AddPage();
$table .= '</table>';
$pdf->SetXY(10, 40);
$pdf->writeHTML($table, true, false, false, false, '');
$pdf->Output($naslov.  "-" . $datum. ".pdf");


?>