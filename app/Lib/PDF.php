<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require("pdffolder/html2fpdf_a4.php");

class PDF extends HTML2FPDF {

    function PW_AddPage() {
	$this->AddPage();
    }

    function GeneratePDF($result) {
		$this->AddPage();

	$this->SetFont('Arial', '', 8);
	$this->SetFont('Arial', '', 7);
	

	$debit_note_request = isset($result["debit_note_request"]) ? $result["debit_note_request"] : "";
	$receiptno = isset($result["receiptno"]) ? $result["receiptno"] : "";
	$receipt_issued_by_subagt = isset($result["receipt_issued_by_subagt"]) ? $result["receipt_issued_by_subagt"] : "";
	$row = isset($result["row"]) ? $result["row"] : array();
	$display_payment_request = isset($result["display_payment_request"]) ? $result["display_payment_request"] : "";
	$narration = isset($result["narration"]) ? $result["narration"] : "";
	$compname = isset($result["compname"]) ? $result["compname"] : "";
	$add1 = isset($result["add1"]) ? $result["add1"] : "";
	$retailername = isset($result["retailername"]) ? $result["retailername"] : "";
	$crdate = date('d-m-Y');
	$flag = isset($result["flag"]) ? $result["flag"] : '';
	$amount = isset($result["amount"]) ? $result["amount"] : '';
	
	if ($flag == 'DN') {
	    $receipt = 'DEBIT NOTE';
	    if ($debit_note_request == FALSE)
		$narration = isset($result["narration"]) ? $result["narration"] : '';
	    else
		$narration = isset($result["narration"]) ? $result["narration"] : "";
	}
	elseif ($flag == 'CN') {
	    $receipt = 'CREDIT NOTE';
	} elseif ($flag == "OR") {
	    $receipt = 'RECEIPT';
	}
	$html='';
	$html .='<table width="100%">
    <tbody>
      <tr><td colspan="3"   align="center" style="font-size:20px" ><font size=20><b>'.$compname.'</b></font></td>
       </tr>
       <tr><td colspan="3"   align="center" style="font-size:20px" ><font size=20><b>'.$add1.'</b></font></td>    
       </tr>
       <tr ><td colspan="3" height=20  align="center" style="font-size:20px" ><font size=20><b>'.$receipt.'</b></font></td></tr>
	

       <tr><td><b>Party Name</b></td><td>:</td><td>' . $retailername . '</td></tr>
       <tr><td><b>Request Date</b></td><td>:</td><td>' . $crdate . '</td></tr>
       <tr><td><b>Cash Amount</b></td><td>:</td><td>' . $amount . '</td></tr>';
		if($flag != "OR")
       $html .='<tr><td><b>Narration</b></td><td> : </td><td>'.$narration.'</td></tr>';

	if($flag=="DN"){
	    if($debit_note_request==TRUE){
		$html .='
		   
		    <tr><td> This is a temporary Receipt.Your Receipt has been saved successfully for Authorization.</td></tr>';
	    }
	}
	$html .='
	    <tr><td colspan="3" height=20  align="center"><b>Transaction Completed Successfully.</b></td></tr>
	    <tr><td colspan="3" height=20  align="center"><b>Your Voucher No is : <span style=color:red> '. $receiptno.'</span></b></td></tr>
	    </tbody></table>';

	$this->Ln(0);
	$this->lineheight = 3.5;
	$this->WriteHTML($html);
// $this->Image('img/logo_blue.jpg', 5,11, 80,16,'jpg','',true);
    }

}

?>