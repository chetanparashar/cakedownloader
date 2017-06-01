<?php

class PwPucDetails extends AppModel {

    public $useTable = 'pw_puc_details';

    public function Getdata($request) {
        set_time_limit(0);
        ini_set('memory_limit', '2048M');
        $i = $total=$totalamt=$totaltax=0;
        $reportDataArr = array();
        $header['Platform Usage Charges Report'] = "";
        $header['Month :' . $request['month']] = "";
        $conditions=array('paid_period' => date('Ym', strtotime($request['month'])));
        if(strtoupper($request['party'])=='AGENT'){
            $header["AGENT'S REPORT"] = "";
            $conditions['agentcounter']='Agent';
        }
        $resultData = $this->find('all', array('fields' => array('*'), 'conditions' => $conditions, 'order' => 'entrydate')); 
        if (!empty($resultData)) {
            $agentMaster = ClassRegistry::init('AgentMaster');
            $dbMaster = ClassRegistry::init('DbMaster');
            $state = $dbMaster->find('list', array('fields' => array('serno', 'state'), 'conditions' => array("status >= " => 1, "brand" => "pw", 'serno' =>  Set::extract($resultData, '{n}.PwPucDetails.db_serno'))));
            $agentMaster->virtualFields = array('agentdata' => "CONCAT(agentname,'@@',pan_no)");
            $conditions = array('agentcode' => set::merge(Set::extract($resultData, '{n}.PwPucDetails.agentcode'), Set::extract($resultData, '{n}.PwPucDetails.agentcounter')));
            $partyInfo = $agentMaster->find('list', array('fields' => array('agentcode', 'agentdata'), 'conditions' => $conditions));
        foreach ($resultData as $data) {
                $data=$data['PwPucDetails'];
                $reportDataArr[$i]['Sno.']=$i+1;
                $reportDataArr[$i]['Retailer Receipt No.']=$data['receiptno'];
                $reportDataArr[$i]['Rec.Retailer Receipt No.']=$data['rev_receiptno'];
                $reportDataArr[$i]['Agent Receipt No.']=$data['agt_receiptno'];
                $reportDataArr[$i]['Rec. Agent Receipt No.']=$data['rev_agt_receiptno'];
                $reportDataArr[$i]['Collection Date']=$data['debit_date'];
                $reportDataArr[$i]['State']= isset($state[$data['db_serno']])?$state[$data['db_serno']]:'NA';                
                if(strtoupper($request['party'])=="RETAILER"){
                    $ret= isset($partyInfo[$data['agentcode']])?explode('@@', $partyInfo[$data['agentcode']]):array(0=>'NA',1=>'NA');
                    $agent=isset($partyInfo[$data['agentcounter']])?explode('@@',$partyInfo[$data['agentcounter']]):array(0=>'NA',1=>'NA');
                    $reportDataArr[$i]['Retailer Code']=$data['agentcode'];
                    $reportDataArr[$i]['Retailer Name']=$ret[0];
                    $reportDataArr[$i]['Retailer PAN']=$ret[1];
                    $reportDataArr[$i]['Agent Code']=$data['agentcounter'];
                }else{
                    $reportDataArr[$i]['Agent Code']=$data['agentcode'];
                     $agent== isset($partyInfo[$data['agentcode']])?explode('@@', $partyInfo[$data['agentcode']]):array(0=>'NA',1=>'NA');
                }
                $reportDataArr[$i]['Agent Name']=$agent[0];
                $reportDataArr[$i]['Agent PAN']=$agent[1];
                $reportDataArr[$i]['Amount']=$data['amount'];
                $reportDataArr[$i]['Service Tax']=$data['servicetaxamt'];
                $reportDataArr[$i]['Total Amt.']= $data['amount'] +$data['servicetaxamt'];
                $reportDataArr[$i]['Status']=$data['status'];
                $reportDataArr[$i]['Period']=$data['paid_period'];
                $reportDataArr[$i]['Narration']=$data['narration'];   
                $totalamt+=$data['amount'];
                $totaltax+=$data['servicetaxamt'];
                $total+=$data['amount']+$data['servicetaxamt'];                
                $i++;
            }
                $reportDataArr[$i]['Sno.']='Total';
                $reportDataArr[$i]['Retailer Receipt No.']='';
                $reportDataArr[$i]['Rec.Retailer Receipt No.']='';
                $reportDataArr[$i]['Agent Receipt No.']='';
                $reportDataArr[$i]['Rec. Agent Receipt No.']='';
                $reportDataArr[$i]['Collection Date']='';
                $reportDataArr[$i]['State']='';
                if(strtoupper($request['party'])=="RETAILER"){
                    $header["REATILER'S REPORT"] = "";
                    $reportDataArr[$i]['Retailer Code']='';
                    $reportDataArr[$i]['Retailer Name']='';
                    $reportDataArr[$i]['Retailer PAN']='';
                }
                $reportDataArr[$i]['Agent Code']='';
                $reportDataArr[$i]['Agent Name']='';
                $reportDataArr[$i]['Agent PAN']='';                
                $reportDataArr[$i]['Amount']=$totalamt;
                $reportDataArr[$i]['Service Tax']=$totaltax;
                $reportDataArr[$i]['Total Amt.']=$total;
                $reportDataArr[$i]['Status']='';
                $reportDataArr[$i]['Period']='';
                $reportDataArr[$i]['Narration']='';
        }
        if (count($reportDataArr) == 0) {
            $reportDataArr[0]['Msg'] = "Record Not Found";
        }
        App::import('Vendor', "excel/PwExcel");
        $PwExcel = new PwExcel();
        $filename = $PwExcel->generate($reportDataArr, '', $header);
        return $filename;
    }

}

?>
