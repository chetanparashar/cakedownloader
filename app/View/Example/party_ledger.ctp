<?php

$baseurl = $ResponseArr["baseURL"];
$option = isset($selectedoption) ? $selectedoption : "Agent";
$listArr = isset($list) ? $list : array();
$gdate = new DateTime();
$resultArr = empty($result)?array():$result;  
$curdate = $gdate->Format('d-m-Y');
$fdate = isset($fdate) ? $fdate : $curdate;
$tdate = isset($tdate) ? $tdate : $curdate;
echo $this->Html->script("jquery.ui.datepicker");
echo $this->Html->css(array("jquery.ui.datepicker","jquery.ui.all"));
echo $this->Html->script("chosen.jquery");
echo $this->Html->css("chosen");
echo "<center>";
echo $this->Html->div("pageContentDiv");
echo $this->Html->para("reportHeader1", "Party Ledger", array("style" => "width:100%;position:relative;top:0px;margin-top:1px;margin-bottom:5px;"));
echo $this->Form->create('Bo', array("id" => "partyledger", "target" => "_self", "autocomplete" => "off"));
echo $this->Form->input("Bo.AuthVar", array('id' => 'auth', "type" => "hidden", "class" => "nochange", "value" => $ResponseArr["AuthVar"]));
echo $this->Form->input("Bo.Option", array('id' => 'option_1', "type" => "hidden", "class" => "nochange", "value" => $option));
echo $this->Form->unlockField("Bo.Option");
echo $this->Html->div("msgDiv style18", isset($msg) ? $msg : '&nbsp', array("id" => "msgDiv", "style" => "text-align:center;color:red;margin-top:7.5px;"));
$options = array('Agent' => 'Search By Agent', 'Retailer' => 'Search By Retailer');
$attributes = array('legend' => false,'class'=>'option1','value'=>$option);
echo $this->Form->radio('option', $options, $attributes);
echo $this->Form->unlockField("Bo.option");
echo $this->Form->input('datefrom', array('value'=>$fdate,'id'=>'datefrom', 'label' => array('text'=>'From Date', 'class'=>'labelStyle1'), 'class'=>'inputBox1',"readonly"=>"true"));
echo $this->Form->input('dateto', array('value'=>$tdate,'id'=>'dateto', 'label' => array('text'=>'To Date', 'class'=>'labelStyle1','id'=>'lbl_dateto'), 'class'=>'inputBox1',"readonly"=>"true"));
echo $this->Form->input('search', array('id' => 'search', 'label' => array('text' => 'Search(Code/LoginName)', 'class' =>'labelStyle1','id'=>'lbl_search'), 'class' => ' inputBox2  inputBox1'));
echo $this->Form->button('Find', array("name"=>"find","id" => "find", 'type' => 'button', 'class' => 'button1'));
echo "<div id=content>";
echo $this->Form->input('Bo.list', array('id' => 'list', 'label' => array('text' => "", 'class' => 'labelStyle1'), 'class' => 'inputBox1 chzn-container chzn-select ret',is_array($listArr) ? "options" : "value" =>$listArr));
echo $this->Form->unlockField("Bo.list");
echo '</div>';
echo $this->Form->button('Submit', array("id" => "submit_data","name"=>"gen_report", 'type' => 'button', 'class' => 'button1 button2'));
echo $this->Form->button('Reset', array("id" => "reset", 'type' => 'button', 'class' => 'button1'));
echo $this->Form->input("Bo.file_name", array('id' => 'file_name', "type" => "hidden", "class" => "nochange", "value" => ""));
echo $this->Form->unlockField("Bo.file_name");
echo $this->Form->end();
echo "</div><div id ='div_table'>";
echo "<center>";
echo $this->Form->button("Back",array("type"=>"button","id"=>"back1","class"=>"button1","style" => "margin:auto;width:100px;position:center","title"=>"Back"));
echo "&nbsp;&nbsp;";
echo $this->Form->button("Print",array("type"=>"button","id"=>"print1","class"=>"button1","style" => "margin:auto;width:100px;position:center","title"=>"Print Statement"));
echo "&nbsp;&nbsp;";
echo $this->Form->button("Excel",array("type"=>"button","id"=>"excel1","class"=>"button1","style" => "margin:auto;width:100px;position:center","title"=>"save As Excel"));
echo "<div id ='div_table1'></div>";
echo "<table id=table1 align=center width =99% class='ReportCont'><tr><thead></thead></table>";
echo "</div>";
echo "</center>";
?>
<style>
    .pageContentDiv{
        width: 60%;
        max-width: 60%;
    }
    .inputBox1{   
        width: 35%;
        margin-left: 10%;
        margin-bottom: 10px;
        text-align: center;  
    }
    .inputBox2{   
        float: left;
        width: 35%;
        margin-left: 10%;
        margin-bottom: 10px;
        text-align: center;  
    }
    .labelStyle1{        
        float: left;
        width: 25%;
        margin-left: 10%;
        margin-bottom: 10px;
    }
    .option1
    {
        margin-left: 22%;
        margin-bottom: 4%;
    }
    .button1{
        margin-bottom: 1%;
        margin-left: 2%;
    }
    .button2{
        margin-bottom: 1%;
        margin-left: 40%;
        margin-top: 2px;
    }
    .chzn-container{
        width:48%;
        margin-bottom: 8px;
        margin-left: 10%;
    }
    h4,h5{
        font-size: 20px;
        color: #0088bb;
        font-family: Calibri;
        font-weight: bold;
        position: center;
    }    
    .ReportHeader {
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #A8D8FF), color-stop(1, #BDE0FD) );
        background:-moz-linear-gradient( center top, #BDE0FD 5%, #A8D8FF 100% );
        background-color:#A8D8FF;
        text-indent:0;
        color:#444444;
        font-family:calibri;
        font-size:20px;
        font-style:normal;
        text-decoration:none;
        width:100%;
        position:relative;
        top:0px;
        margin-top:1px;
        margin-bottom:5px;
    }
    .header, .tabcol{
        font-family: Calibri;
        font-style:normal;
        color: #444444;
    }
    .header {
        background: #C0C0C0;
        font-size: 16px;
    }
    .tabcol{
        font-size: 14px;
        background: #E0E0E0;
        color:black;
    }
    .ReportCont{
        width:99%;
        border-radius:10px; 
        border:1px solid black;
    }
</style>
<script>
    var body = '';
    var html = '';
    var height = '';
    var config = {
        '.chzn-select': {},
        '.chzn-select-deselect': {allow_single_deselect: true},
        '.chzn-select-no-single': {disable_search_threshold: 10},
        '.chzn-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chzn-select-width': {width: "35%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    $("document").ready(function()
    {
        var url = "<?= $baseurl ?>";
        $('#content,#content1').hide();
        var finn = $("#finYear").val().split("-");
        var finyear = finn[2] + '-' + finn[1] + '-' + finn[0];
        $("#datefrom").datepicker({minDate: finyear, maxDate: "0", dateFormat: 'dd-mm-yy',
            onSelect: function(selectedDate) {
                $("#dateto").datepicker("option", "minDate", selectedDate);
                $(this).change();
            }
        });
        $("#dateto").datepicker({minDate: finyear, maxDate: "0", dateFormat: 'dd-mm-yy',
            onSelect: function(selectedDate) {
                $("#datefrom").datepicker("option", "maxDate", selectedDate);
                $(this).change();
            }
        });
        $('#div_table').hide();
        $('#find').click(function()
        {
            if ($('#search').val() == "")
            {
                $('#msgDiv').html('Please Fill The Text Field.');
                return false;
            }
            var len = $('#search').val();
            if (len < 3)
            {
                $('#msgDiv').html("Find String Must have at least 3 characters");
                return;
            }
            $('#partyledger').submit();
        });
        if ("<?= count($listArr)?>" >= 1) {
            $('#content').show();
        }
        $('.option1').click(function() {
            $('#option_1').val($(this).val());
            $('#content').hide();
            $('#search').val('');
            $('#list option').remove();
        });
        $('#reset').click(function()
        {
            $('#content').hide();
            $('#search').val('');
            $('#list option').remove();
            $("#datefrom,#dateto").val("<?= $curdate ?>");
            $('#msgDiv').html('&nbsp;');
            $('#table1').hide();
        });

        $('#submit_data').click(function()
        {
            $('#msgDiv').html('&nbsp;');
            var dataString = 'fromdate=' + $("#datefrom").val() + '&todate=' + $("#dateto").val() + '&flag=PARTYLEDGER&code=' + $('#list').val() + "&option=" + $('#option_1').val();
           // alert(dataString);
            var data = ajaxRequest(url + "/JsonGetBillerData", dataString);
            //alert(data);
            var JSONObject = JSON.parse(data);
            if (JSONObject['tag'].toUpperCase().indexOf("#DATA:") !== -1 || JSONObject['tag'].toUpperCase().indexOf("#ERROR:") !== -1) {
                $("#msgDiv").html(JSONObject['tag']);
                return false;
            }
            else
            {
                               delete JSONObject["tag"];
                $('#file_name').val(JSONObject['filename']);
                delete JSONObject["filename"];
                $('#div_table1').empty();
                $('#div_table1').append("<center><h4 style='color:grey;'>Party Ledger Report<br/><br/>Of Date " + JSONObject['date'] + "</h4></center>");
                delete JSONObject["date"];
                $("#msgDiv").html('&nbsp;');
                var string = "";
                var css = "";
                var str = "";
                $.each(JSONObject, function(row) {
                    var rowdata = JSONObject[row];
                    if (rowdata['partyname'] != undefined)
                    {
                        //str += "<tr><td colspan=5>&nbsp;</td></tr>";
                        str += "<tr><td colspan=5 class=ReportHeader>" + rowdata['partyname'] + "</td></tr><tr class='header'><th>T.Date</th><th width='50%'>Particulars</th><th>Debit</th><th>Credit</th><th>Balance</th></tr>";
                    }
                    if (rowdata['T.Date'] != undefined)
                    {
                        str += "<tr class='tabcol'><td>" + rowdata['T.Date'] + "</td><td>" + rowdata['Particulars'] + "</td><td align=right>" + rowdata['Debit'] + "</td><td align=right>" + rowdata['Credit'] + "</td><td align=right>" + rowdata['Balance'] + "</td></tr>";
                    }
                    //string += "";
                });
                $('#table1 thead').remove();
                $('#table1').append("<thead></thead>");
                $('#table1 thead').append(str);
                $('#div_table').show();
                $('.pageContentDiv').hide();
            }
            return true;
        });
        $('#print1').click(function()
        {
            $('#print1,#back1,#excel1').hide();
            $("#div_table2").attr("id", "nonscroll");
            var myWindow = window.open("", "_blank");
            var html = $("#div_table").html();
            myWindow.document.write(html);
            myWindow.document.close();
            myWindow.print();
            $('#print1').show();
            $("#nonscroll").attr("id", "div_table2");
            $('#print1,#back1,#excel1').show();
            myWindow.close();
        });

        $('#back1').click(function()
        {
            $('.pageContentDiv').show();
            $('#div_table').hide();
        });

        $('#excel1').click(function()
        {
            var dataString = "filename=" + $('#file_name').val() + "&flag=DOWNLOADEXCELFILE";
            downloadFile(url + "/JsonDownloadReport", dataString);
            return true;
        });
    });
</script>
