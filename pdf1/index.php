<?php
include('_requires/connect.php');
require('pdf/fpdf.php');



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
	//$this->Image('images/IBM_Logo.jpg',10,0,33); //Insert Image in header
	//Arial bold 15
	$this->SetFont('Arial','B',25); // Font Type and Size
	$this->SetTextColor(204,102,0); // Font Color
	
	$this->Cell(30,5,'Biotech',0,0,'L');
	$this->SetFont('Times','I',7);
	$this->SetTextColor(255,153,51); // Font Color
	
	$this->Cell(40,1,'"World Leader in Nano Biotic',0,0,'C');
	$this->Ln(3);
	$this->Cell(30);
	$this->Cell(40,1,'Health Care Products"',0,0,'C');
	$this->Ln(10);
	
   
}

//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','IB',8);
	$this->SetTextColor(204,0,0); // Font Color
    //Page number
    $this->Cell(0,10,'Biotech Weekly Report : Page '.$this->PageNo().'/{nb}',0,0,'C');
}
//End of Page Header

function Title_Report($name)
{
	$Name = $name;
	
	$this->SetFont('Arial','B',12); // Set Font to be used
	$this->SetTextColor(153,153,153); // Font Color
	$this->Cell(0,4,'ADMIN REPORT',0,1,'C');
	$this->Ln(0);
	$this->SetFont('Arial','B',10); // Set Font to be used
	$this->Cell(0,4,$Name,0,1,'C');
	$this->Ln(0);
	$this->Cell(0,4,$this->daterForm(),0,1,'C');
	$this->Ln(3);
}

function Title_Sub($weekNo,$startDate,$endDate){

	$WeekNo = $weekNo;
	$StartDate = $startDate;
	$EndDate = $endDate;
	
	$this->SetFont('Arial','B',9); // Set Font to be used
	$this->SetTextColor(0,0,0); // Font Color
	$this->Cell(0,5,'Week '.$WeekNo.' ( '.$StartDate.' to '.$EndDate.' )',0,1);
	$this->Ln(1);
}
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
	$this->SetFont('Arial','',8);
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
$pdf=new PDF('P','mm','Letter');   
 /* PAGE SETTING
 	* A3
    * A4
    * A5
    * Letter
    * Legal */
	
$pdf->AliasNbPages();

// Landscape if L, no value is Portrate... Default = Portrate
$pdf->AddPage();

//user who generates the reports//
$pdf->Title_Report($_SESSION['']);
/////////////////////////////////

//for week no//
$i=1;
//delimeter for new week //
$newTable = 1;
$startLimiter = 0;//increment by 7
$endLimiter = 7;
///////////////


$query="Select * from members;";
			$result = mysql_query($query) or die (mysql_error());
			$num = mysql_num_rows($result);
		
		
			while($row = mysql_fetch_array($result)){
			
			
			if($newTable == 1){
				//get start and end//
				//FOR WEEK NO START DATE AND END DATE//
				//$pdf->Title_Sub($i,'2006-01-01','2006-01-07');
				//////////////////////////////////////
			

				$header=array('ID No','Full Name','No of Pairs','Excess Pairs','Accumulated Income','Received Income','Company Income');
				// Array size based here in $w
				$w=array(25,50,20,20,27,27,27);
				$pdf->Table_Headers($header,$w);
				$newTable = 0;
			}
//Multi Cell Generation
 $pdf->SetWidths(array(25,50,20,20,27,27,27));// Set Width of each cell

			
			//id, firstName, middleName, lastName, noOfPairs, excessPairs, accumulatedIncome, receivedIncome, companyIncome, dateMember
					$id = $row['id'];
					$fName = $row['firstName'];
					$aName = $row['middleName'];
					$lName = $row['lastName'];
					$noPairs = $row['noOfPairs'];
					$exPairs = $row['excessPairs'];
					$acPairs = $row['accumulatedIncome'];
					$rePairs = $row['receivedIncome'];
					$coName = $row['companyIncome'];
					//$dateSigned = $row['dateMember'];
				
				$pdf->Row(array($id,$fName .' '. $aName .' '. $lName ,$noPairs,$exPairs,$acPairs,$rePairs,$coName),'C');
				$rower++;
			}


//End Multi Cell Generation


// Output PDF to Browser
$pdf->Output();

?>