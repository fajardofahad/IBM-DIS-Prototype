<?php
session_start();

include('../db/connect.php');
require('../pdf/fpdf.php');



class PDF extends FPDF
{

function daterForm(){
	$now = $this->Sytem_Time();//tem Date
	return $now;
}
//Page header
function Header()
{
	
	
	//Logo
	$this->Image('../images/ibm.jpg',10,10,25); //Insert Image in header
	
	$this->SetFont('Arial','B',12); // Font Type and Size
	$this->SetTextColor(0,0,0); // Font Color
	$this->Cell(120,5,'IBM Business Services, Inc.',0,0,'C');
	$this->Ln();
	$this->SetFont('Arial','I',8);
	$this->Cell(120,5,'"We Accelerate Change Together"',0,0,'C');
	   
}

//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','IB',8);
	$this->SetTextColor(0,0,0); // Font Color
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
//End of Page Header


function Table_Headers($header,$w)
{
    //Colors, line width and bold font
    $this->SetFillColor(153,153,153);
    $this->SetTextColor(0);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial','B','7');
	
    //Header
	
	//Output table header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],5,$header[$i],1,0,'C',1);
    $this->Ln();
}

//Multi Cell with wrap
var $widths;
var $aligns;

function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data,$CellAlignment)
{
	$this->SetFont('Arial','',6);
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : $CellAlignment;
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}
//End of Multi Cell with wrap

////// SQL Query /////
function Sytem_Time(){

// system date and time
			$query1="Select NOW();";
			$result = mysql_query($query1) or die (mysql_error());
			$num1 = mysql_num_rows($result);
			
			for($i=0; $i<$num1; $i++) {
		
				$row = mysql_fetch_array($result);
				$datePosted = $row[$i];
			}
			// end system date
	return $datePosted;
}

///// End of SQL Query ///

}// end of class extend

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////code starts here ///////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

//Instanciation of inherited class
$pdf=new PDF('P','mm','A4');   
 /* PAGE SETTING
 	* A3
    * A4
    * A5
    * Letter
    * Legal */
	
$pdf->AliasNbPages();
$pageNo = $pdf->AliasNbPages();
//get type of request
$requestNo = $_GET['idInquiry'];

if(isset($_GET['idRfqType']) && $_GET['idRfqType'] != ""){
	$rfqType = $_GET['idRfqType'];
}

$accronim = substr($requestNo,0,3);

// Landscape if L, no value is Portrate... Default = Portrate
$pdf->AddPage('L');

$pdf->Ln(15);
		$header=array('To : ','','From : ',$_SESSION['NAME']);
		$w=array(15,80,15,80);
		$pdf->Table_Headers($header,$w);
		$header=array('Tel No : ','','Tel No : ',$_SESSION['EMPLOYEECONTACTNO']);
		$w=array(15,80,15,80);
		$pdf->Table_Headers($header,$w);
		$header=array('Fax No : ','','Fax No : ','');
		$w=array(15,80,15,80);
		$pdf->Table_Headers($header,$w);
		$header=array('Email : ','','Email : ',$_SESSION['EMAIL']);
		$w=array(15,80,15,80);
		$pdf->Table_Headers($header,$w);
		$header=array('Re : ','FOR QUOTATION','RFQ No : ',$requestNo);
		$w=array(15,80,15,80);
		$pdf->Table_Headers($header,$w);
		
		$pdf->Ln(5);
		$pdf->SetFont('Arial','B',7); // Font Type and Size
		$pdf->SetTextColor(0,0,0); // Font Color
		$pdf->Cell(130,5,'Kindy quote for the following items and submit to us within the day or as soon as possible thru fax or email.',0,0,'C');
//declare paging type
if($accronim == 'RFQ'){

//generation of header table
	if($rfqType == 'Basic Item Inquiry'){
		
		$pdf->Ln(10);
		$header=array('Item No','Item Description','Quantity','Size','Color','Material','Features','Brand','Model No','Part No','Others','Quoted Price (VAT EX)');
		$w=array(15,40,15,20,20,20,20,20,25,20,30,30);
		$pdf->Table_Headers($header,$w);
		
		$pdf->SetWidths(array(15,40,15,20,20,20,20,20,25,20,30,30));
		
		$sql_rfq = 'Select * from rfq_basic_item where requestNo = \''.$requestNo.'\'';
		$result = mysql_query($sql_rfq) or die(mysql_error());
		$num = mysql_num_rows($result);
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);

					$pdf->Row(array($row['itemNo'],$row['items'],$row['quantity'],$row['size'],$row['color'],$row['material'],$row['features'],$row['brand'],$row['modelNo'],$row['partNo'],$row['others'],''),'C');
				}
			}

	}elseif($rfqType == 'Service Inquiry'){
		
		$pdf->Ln(10);
		$header=array('Item No','Business Justification','Nature of Service','Start Date','End Date','Quoted Price (VAT EX)');
		$w=array(15,50,40,15,20,30);
		$pdf->Table_Headers($header,$w);
		
		$pdf->SetWidths(array(15,50,40,15,20,30));
		
		$sql_rfq = 'Select * from rfq_service, rfq where rfq_service.requestNo = \''.$requestNo.'\' and rfq.requestNo = rfq_service.requestNo';
		$result = mysql_query($sql_rfq) or die(mysql_error());
		$num = mysql_num_rows($result);
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);
					
					$pdf->Row(array('1',$row['businessJustification'],$row['natureOfService'],$row['startDate'],$row['endDate'],''),'C');
				}
			}
			
	}elseif($rfqType == 'Customized Pre-Printed Inquiry'){
		$pdf->Ln(10);
		$header=array('Item No','Form Type','Quantity','Unit of Measure','Material','Size','Color','Printing','Quoted Price (VAT EX)');
		$w=array(15,20,20,30,20,20,20,20,50);
		$pdf->Table_Headers($header,$w);
		
		$pdf->SetWidths(array(15,20,20,30,20,20,20,20,50));
		
		$sql_rfq = 'Select * from rfq_pre_printed where requestNo = \''.$requestNo.'\'';
		$result = mysql_query($sql_rfq) or die(mysql_error());
		$num = mysql_num_rows($result);
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);
							
					$pdf->Row(array($row['itemNo'],$row['formType'],$row['quantity'],$row['unitOfMeasure'],$row['material'],$row['size'],$row['color'],$row['printing'],''),'C');
				}
			}
	
	}elseif($rfqType == 'Customized Item Inquiry'){
		$pdf->Ln(10);
		$header=array('Item No','Item Description','Quantity','Material','Size','Color','Quoted Price (VAT EX)');
		$w=array(15,20,20,30,20,20,30);
		$pdf->Table_Headers($header,$w);
		
		$pdf->SetWidths(array(15,20,20,30,20,20,30));
		
		$sql_rfq = 'Select * from rfq_item where requestNo = \''.$requestNo.'\'';
		$result = mysql_query($sql_rfq) or die(mysql_error());
		$num = mysql_num_rows($result);
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);
					$pdf->Row(array($row['itemNo'],$row['item'],$row['quantity'],$row['material'],$row['size'],$row['color'],''),'C');
				}
			}
	
	}elseif($rfqType == 'Manpower Inquiry'){
		$pdf->Ln(10);
		$header=array('Item No','Type Catalog','Contractor Name','Vendor','Designation','Department','ImmediateSupervisor','DateStart','Date End','Others','Quoted Price (VAT EX)');
		$w=array(15,30,30,30,20,20,30,15,15,40,30);
		$pdf->Table_Headers($header,$w);
		
		$pdf->SetWidths(array(15,30,30,30,20,20,30,15,15,40,30));
		
		$sql_rfq = 'Select * from rfq_manpower where requestNo = \''.$requestNo.'\'';
		$result = mysql_query($sql_rfq) or die(mysql_error());
		$num = mysql_num_rows($result);
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);
					$pdf->Row(array($row['itemNo'],$row['typeOfCatalog'],$row['contractorName'],$row['vendor'],$row['designation'],$row['department'],$row['immediateSupervisor'],$row['dateStart'],$row['dateEnd'],$row['others'],''),'C');
				}
			}
	
	}
}elseif($accronim == 'MIR'){
		$pdf->Ln(10);
		$header=array('Item No','Description','Unit of Measure','Quoted Price (VAT EX)');
		$w=array(15,70,40,30);
		$pdf->Table_Headers($header,$w);
		
		$pdf->SetWidths(array(15,70,40,30));
		
		$sql_rfq = 'Select * from mir where requestNo = \''.$requestNo.'\'';
		$result = mysql_query($sql_rfq) or die(mysql_error());
		$num = mysql_num_rows($result);
		
			if ($num > 0) {
				for($i=0; $i<$num; $i++) {
					$row = array();
					$row = mysql_fetch_array($result);
					$pdf->Row(array('1',$row['description'],'',''),'C');
				}
			}

}


// Output PDF to Browser
$pdf->Output();

?>