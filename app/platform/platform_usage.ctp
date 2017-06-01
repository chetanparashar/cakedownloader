<?php 
$party=array('AGENT'=>'Agent','RETAILER'=>'Retailer'); 
echo $this->Html->div( "pageContentDiv" );
echo $this->Html->para( "reportHeader1", "Platform Usage Report", array("style"=>"width:100%;position:relative;top:0px;margin-top:1px;margin-bottom:5px;") );
echo $this->Html->div("msgDiv style18", isset($smsg)?$smsg:'', array("id"=>"smsgDiv","style"=>"width:90%;text-align:center;color:green;margin-top:7.5px;"));
echo $this->Html->div("msgDiv style18", isset($msg)?$msg:'', array("id"=>"msgDiv","style"=>"width:90%;text-align:center;color:red;margin-bottom:7.5px;"));  
echo $this->Form->create('Bo',array("id"=>"activeretailer","target"=>"_self","autocomplete"=>"off"));
echo $this->Form->input( "Bo.AuthVar", array('id'=>'auth',"type"=>"hidden", "value"=>$ResponseArr["AuthVar"]));
echo $this->Form->input('party', array('id'=>'party', 'label' => array('text'=>'Select Party', 'class'=>'labelStyle1'), 'class'=>'inputBox1','options'=>$party));
echo $this->Form->input('month', array('id'=>'month', 'label' => array('text'=>'Select Month', 'class'=>'labelStyle1'), 'class'=>'inputBox1','options'=>''));
echo $this->Form->button("Excel", array("type" => "button", "id" => "excel", 'class' => 'button1 buttonn1'));
echo $this->Form->end();
echo $this->Html->useTag("tagend","div");
?>        
<style>
.pageContentDiv{
                width: 40%;                
        }
.labelStyle1,.inputBox1{
        float: left;
        margin-bottom:10px;
        width:25%;
}
.inputBox1{
        width:40%;
}
.buttonn1{        
        margin-bottom: 10px;
        margin-left: 42%;
}
</style>
<script>
    $("document").ready(function(){
        var finn = $("#finYear").val().split("-");
        var today = new Date();
        var curmm = today.getMonth();
        var mm = curmm;
        var yyyy = today.getFullYear();
        var month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var monthRow = $('#month').append("<option value='' >----Select Month----</option>");
        if (yyyy != finn[0]) {
            mm = 11
        }
        for (var i = 3; i <= mm; i++) {
            monthRow += $('#month').append("<option value=" + month[i] + "-" + finn[0] + ">" + month[i] + " " + finn[0] + "</option>");
        }
        if (yyyy != finn[0]) {
            var year = parseInt(finn[0]) + 1;
            if (year < yyyy) {
                for (var i = 0; i <= 2; i++)
                    monthRow += $('#month').append("<option value=" + month[i] + "-" + year + ">" + month[i] + " " + year + "</option>");
            }
            else {
                for (var i = 0; i <= curmm && i <= 2; i++)
                    monthRow += $('#month').append("<option value=" + month[i] + "-" + year + ">" + month[i] + " " + year + "</option>");
            }
        }
        $('#month').append(monthRow);

        $('#excel').click(function(){            
                var dataString = "month=" +$("#month").val()+"&party=" +$("#party").val()+ "&flag=PLATFORMUSAGE";
                downloadFile(baseURL + "/JsonDownloadReport", dataString);            
        });
    });
</script>

