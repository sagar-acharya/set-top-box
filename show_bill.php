<?php
require_once('checkSession.php');
require_once('core/class/SessionController.php');
$sessionObject = new SessionController();
$customerData = $sessionObject->getCustomerData();
//var_dump($customerData);exit;
foreach($customerData['billing_info'] as $billing){
    $boxId[] = $billing['stb_id'];
}
$stbId = '';
$boxId = array_unique($boxId);
$k=0;
foreach($boxId as $box_id){
    $stbId[$k] = $box_id;
    $k++;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
<HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <META http-equiv="X-UA-Compatible" content="IE=8">
    <TITLE>Customer Bill</TITLE>
    <STYLE type="text/css">

        body {margin-top: 0px;margin-left: 0px;}

        #page_1 {position:relative; overflow: hidden;margin: 96px 0px 99px 40px;padding: 0px;border: none;width: 776px;height: 861px;}

        #page_1 #dimg1 {position:absolute;top:513px;left:434px;z-index:-1;width:302px;height:348px;}
        #page_1 #dimg1 #img1 {width:302px;height:348px;}




        #page_2 {position:relative; overflow: hidden;margin: 96px 0px 622px 0px;padding: 0px;border: none;width: 816px;}

        #page_2 #dimg1 {position:absolute;top:0px;left:40px;z-index:-1;width:736px;height:270px;}
        #page_2 #dimg1 #img1 {width:736px;height:270px;}

        #page_2 #inl_img1 {position:relative;width:7px;height:24px;}



        .dclr {clear:both;float:none;height:1px;margin:0px;padding:0px;overflow:hidden;}

        .ft0{font: bold 13px 'Arial';line-height: 16px;}
        .ft1{font: bold 14px 'Arial';line-height: 16px;}
        .ft2{font: 13px 'Arial';line-height: 16px;}
        .ft3{font: 14px 'Arial';line-height: 16px;}
        .ft4{font: 14px 'Arial';line-height: 12px;}
        .ft5{font: 1px 'Arial';line-height: 12px;}
        .ft6{font: 14px 'Arial';line-height: 14px;}
        .ft7{font: 1px 'Arial';line-height: 14px;}
        .ft8{font: 1px 'Arial';line-height: 1px;}
        .ft9{font: 1px 'Arial';line-height: 8px;}
        .ft10{font: 1px 'Arial';line-height: 15px;}
        .ft11{font: 14px 'Arial';line-height: 15px;}
        .ft12{font: 1px 'Arial';line-height: 9px;}
        .ft13{font: bold 14px 'Arial';line-height: 15px;}
        .ft14{font: bold 14px 'Arial';line-height: 22px;}
        .ft15{font: 14px 'Arial';line-height: 22px;}

        .p0{text-align: center;padding-left: 102px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
        .p1{text-align: left;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
        .p2{text-align: left;padding-left: 8px;margin-top: 55px;margin-bottom: 0px;}
        .p3{text-align: left;padding-left: 6px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
        .p4{text-align: left;padding-left: 26px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
        .p5{text-align: left;padding-left: 27px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
        .p6{text-align: left;padding-left: 45px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
        .p7{text-align: left;padding-left: 523px;margin-top: 0px;margin-bottom: 0px;}
        .p8{text-align: left;padding-left: 551px;margin-top: 9px;margin-bottom: 0px;}
        .p9{text-align: right;padding-right: 197px;margin-top: 1px;margin-bottom: 0px;}
        .p10{text-align: right;padding-right: 198px;margin-top: 9px;margin-bottom: 0px;}
        .p11{text-align: left;padding-left: 41px;margin-top: 57px;margin-bottom: 0px;}
        .p12{text-align: left;padding-left: 48px;padding-right: 98px;margin-top: 171px;margin-bottom: 0px;}

        .td0{padding: 0px;margin: 0px;width: 490px;vertical-align: bottom;}
        .td1{padding: 0px;margin: 0px;width: 102px;vertical-align: bottom;}
        .td2{border-left: #000000 1px solid;border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 7px;vertical-align: bottom;background: #e6e6e6;}
        .td3{border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 188px;vertical-align: bottom;background: #e6e6e6;}
        .td4{border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 155px;vertical-align: bottom;background: #e6e6e6;}
        .td5{border-right: #000000 1px solid;border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 17px;vertical-align: bottom;background: #e6e6e6;}
        .td6{border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 220px;vertical-align: bottom;background: #e6e6e6;}
        .td7{border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 146px;vertical-align: bottom;background: #e6e6e6;}
        .td8{border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 1px;vertical-align: bottom;background: #000000;}
        .td9{border-left: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 7px;vertical-align: bottom;background: #e6e6e6;}
        .td10{border-right: #e6e6e6 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 83px;vertical-align: bottom;background: #e6e6e6;}
        .td11{border-right: #e6e6e6 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 24px;vertical-align: bottom;background: #e6e6e6;}
        .td12{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 79px;vertical-align: bottom;background: #e6e6e6;}
        .td13{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 155px;vertical-align: bottom;background: #e6e6e6;}
        .td14{border-right: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 17px;vertical-align: bottom;background: #e6e6e6;}
        .td15{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 69px;vertical-align: bottom;background: #e6e6e6;}
        .td16{border-right: #e6e6e6 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 39px;vertical-align: bottom;background: #e6e6e6;}
        .td17{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 111px;vertical-align: bottom;background: #e6e6e6;}
        .td18{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 146px;vertical-align: bottom;background: #e6e6e6;}
        .td19{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 1px;vertical-align: bottom;background: #000000;}
        .td20{border-left: #000000 1px solid;padding: 0px;margin: 0px;width: 7px;vertical-align: bottom;}
        .td21{border-right: #000000 1px solid;padding: 0px;margin: 0px;width: 108px;vertical-align: bottom;}
        .td22{padding: 0px;margin: 0px;width: 79px;vertical-align: bottom;}
        .td23{padding: 0px;margin: 0px;width: 155px;vertical-align: bottom;}
        .td24{border-right: #000000 1px solid;padding: 0px;margin: 0px;width: 17px;vertical-align: bottom;}
        .td25{padding: 0px;margin: 0px;width: 111px;vertical-align: bottom;}
        .td26{padding: 0px;margin: 0px;width: 146px;vertical-align: bottom;}
        .td27{padding: 0px;margin: 0px;width: 1px;vertical-align: bottom;background: #000000;}
        .td28{border-left: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 7px;vertical-align: bottom;}
        .td29{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 84px;vertical-align: bottom;}
        .td30{border-right: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 24px;vertical-align: bottom;}
        .td31{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 79px;vertical-align: bottom;}
        .td32{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 155px;vertical-align: bottom;}
        .td33{border-right: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 17px;vertical-align: bottom;}
        .td34{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 69px;vertical-align: bottom;}
        .td35{border-right: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 39px;vertical-align: bottom;}
        .td36{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 111px;vertical-align: bottom;}
        .td37{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 146px;vertical-align: bottom;}
        .td38{padding: 0px;margin: 0px;width: 8px;vertical-align: bottom;}
        .td39{padding: 0px;margin: 0px;width: 84px;vertical-align: bottom;}
        .td40{padding: 0px;margin: 0px;width: 25px;vertical-align: bottom;}
        .td41{padding: 0px;margin: 0px;width: 18px;vertical-align: bottom;}
        .td42{padding: 0px;margin: 0px;width: 69px;vertical-align: bottom;}
        .td43{padding: 0px;margin: 0px;width: 151px;vertical-align: bottom;}
        .td44{padding: 0px;margin: 0px;width: 1px;vertical-align: bottom;}
        .td45{border-right: #000000 1px solid;padding: 0px;margin: 0px;width: 126px;vertical-align: bottom;}
        .td46{border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 111px;vertical-align: bottom;}
        .td47{border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 146px;vertical-align: bottom;}
        .td48{padding: 0px;margin: 0px;width: 188px;vertical-align: bottom;}
        .td49{border-right: #000000 1px solid;padding: 0px;margin: 0px;width: 39px;vertical-align: bottom;}
        .td50{padding: 0px;margin: 0px;width: 40px;vertical-align: bottom;}
        .td51{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 8px;vertical-align: bottom;}
        .td52{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 104px;vertical-align: bottom;}
        .td53{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 18px;vertical-align: bottom;}
        .td54{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 151px;vertical-align: bottom;}
        .td55{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 1px;vertical-align: bottom;}
        .td56{border-left: #000000 1px solid;padding: 0px;margin: 0px;width: 7px;vertical-align: bottom;background: #e6e6e6;}
        .td57{border-right: #000000 1px solid;padding: 0px;margin: 0px;width: 83px;vertical-align: bottom;background: #e6e6e6;}
        .td58{padding: 0px;margin: 0px;width: 104px;vertical-align: bottom;background: #e6e6e6;}
        .td59{padding: 0px;margin: 0px;width: 155px;vertical-align: bottom;background: #e6e6e6;}
        .td60{border-right: #e6e6e6 1px solid;padding: 0px;margin: 0px;width: 17px;vertical-align: bottom;background: #e6e6e6;}
        .td61{padding: 0px;margin: 0px;width: 69px;vertical-align: bottom;background: #e6e6e6;}
        .td62{padding: 0px;margin: 0px;width: 151px;vertical-align: bottom;background: #e6e6e6;}
        .td63{padding: 0px;margin: 0px;width: 146px;vertical-align: bottom;background: #e6e6e6;}
        .td64{border-right: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 83px;vertical-align: bottom;background: #e6e6e6;}
        .td65{border-right: #e6e6e6 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 17px;vertical-align: bottom;background: #e6e6e6;}
        .td66{border-right: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 83px;vertical-align: bottom;}
        .td67{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 25px;vertical-align: bottom;}
        .td68{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 40px;vertical-align: bottom;}

        .tr0{height: 16px;}
        .tr1{height: 23px;}
        .tr2{height: 12px;}
        .tr3{height: 14px;}
        .tr4{height: 27px;}
        .tr5{height: 17px;}
        .tr6{height: 8px;}
        .tr7{height: 15px;}
        .tr8{height: 9px;}
        .tr9{height: 24px;}
        .tr10{height: 25px;}
        .tr11{height: 49px;}
        .tr12{height: 40px;}
        .tr13{height: 33px;}

        .t0{width: 592px;margin-left: 29px;font: 14px 'Arial';}
        .t1{width: 736px;margin-top: 30px;font: 14px 'Arial';}

    </STYLE>
</HEAD>

<BODY>
<DIV id="page_1">
<DIV id="dimg1">
    <!--    <IMG src="Blank-Invoice-Template_images/Blank-Invoice-Template1x1.jpg" id="img1">-->
</DIV>


<TABLE cellpadding=0 cellspacing=0 class="t0">
    <TR>
        <TD class="tr0 td0"><P class="p0 ft0" style="font-size:20px;">ANIL NETWORK</P></TD>
        <TD class="tr0 td1"><P class="p1 ft1">INVOICE</P></TD>
    </TR>
    <TR>
        <TD class="tr1 td0"><P class="p0 ft2"></P></TD>
        <TD class="tr1 td1"><P class="p1 ft3">Invoice Number:</P></TD>
    </TR>
    <TR>
        <TD class="tr2 td0"><P class="p1 ft4">Company Logo Here</P></TD>
        <TD class="tr2 td1"><P class="p1 ft5">&nbsp;</P></TD>
    </TR>
    <TR>
        <TD class="tr3 td0"><P class="p0 ft6">Nawabganj, Varanasi</P></TD>
        <TD class="tr3 td1"><P class="p1 ft7">&nbsp;</P></TD>
    </TR>
    <TR>
        <TD class="tr1 td0"><P class="p0 ft2">9935819665,9580208522</P></TD>
        <TD class="tr1 td1"><P class="p1 ft3">Date</P></TD>
    </TR>
    <TR>
        <TD class="tr4 td0"><P class="p0 ft2"></P></TD>
        <TD class="tr4 td1"><P class="p1 ft8">&nbsp;</P></TD>
    </TR>
</TABLE>
<P class="p2 ft3">Customer Information:</P>
<TABLE cellpadding=0 cellspacing=0 class="t1">
<TR>
    <TD class="tr5 td2"><P class="p1 ft8">&nbsp;</P></TD>
    <TD colspan=3 class="tr5 td3"><P class="p1 ft1">Billing Address:</P></TD>
    <TD class="tr5 td4"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr5 td5"><P class="p1 ft8">&nbsp;</P></TD>
    <TD colspan=3 class="tr5 td6"><P class="p3 ft1">Set Top Box Info:</P></TD>
    <TD class="tr5 td7"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr5 td8"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr6 td9"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td10"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td11"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td12"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td13"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td14"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td15"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td16"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td17"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td18"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td19"><P class="p1 ft9">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr0 td20"><P class="p1 ft8">&nbsp;</P></TD>
    <TD colspan=2 class="tr0 td21"><P class="p1 ft3">Name:</P></TD>
    <TD class="tr0 td22"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr0 td23"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr0 td24"><P class="p1 ft8">&nbsp;</P></TD>
    <TD colspan=2 class="tr0 td21"><P class="p3 ft3">Set Top Box 1:</P></TD>
    <TD class="tr0 td25"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr0 td26"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr0 td27"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr6 td28"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td29"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td30"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td31"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td32"><P class="p1 ft9">&nbsp;</P><?php echo $customerData['personal_info']['name'];?></TD>
    <TD class="tr6 td33"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td34"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td35"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td36"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td37"><P class="p1 ft9">&nbsp;</P><?php if(isset($stbId[0]) && !empty($stbId[0])) echo $stbId[0];?></TD>
    <TD class="tr6 td19"><P class="p1 ft9">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr7 td20"><P class="p1 ft10">&nbsp;</P></TD>
    <TD colspan=2 class="tr7 td21"><P class="p1 ft11">Address:</P></TD>
    <TD class="tr7 td22"><P class="p1 ft10">&nbsp;</P></TD>
    <TD class="tr7 td23"><P class="p1 ft10">&nbsp;</P></TD>
    <TD class="tr7 td24"><P class="p1 ft10">&nbsp;</P></TD>
    <TD colspan=2 class="tr7 td21"><P class="p3 ft11">Set Top Box 2:</P></TD>
    <TD class="tr7 td25"><P class="p1 ft10">&nbsp;</P></TD>
    <TD class="tr7 td26"><P class="p1 ft10">&nbsp;</P></TD>
    <TD class="tr7 td27"><P class="p1 ft10">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr8 td28"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td29"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td30"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td31"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td32"><P class="p1 ft12">&nbsp;</P><?php echo $customerData['personal_info']['address'];?></TD>
    <TD class="tr8 td33"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td34"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td35"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td36"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td37"><P class="p1 ft12">&nbsp;</P><?php if(isset($stbId[1]) && !empty($stbId[1])) echo $stbId[1];?></TD>
    <TD class="tr8 td19"><P class="p1 ft12">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr7 td20"><P class="p1 ft10">&nbsp;</P></TD>
    <TD colspan=2 class="tr7 td21"><P class="p1 ft11">PAF No:</P></TD>
    <TD class="tr7 td22"><P class="p1 ft10">&nbsp;</P></TD>
    <TD class="tr7 td23"><P class="p1 ft10">&nbsp;</P></TD>
    <TD class="tr7 td24"><P class="p1 ft10">&nbsp;</P></TD>
    <TD colspan=2 class="tr7 td21"><P class="p3 ft11">Set Top Box 3:</P></TD>
    <TD class="tr7 td25"><P class="p1 ft10">&nbsp;</P></TD>
    <TD class="tr7 td26"><P class="p1 ft10">&nbsp;</P></TD>
    <TD class="tr7 td27"><P class="p1 ft10">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr8 td28"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td29"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td30"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td31"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td32"><P class="p1 ft12">&nbsp;</P><?php echo $customerData['pafNo'];?></TD>
    <TD class="tr8 td33"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td34"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td35"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td36"><P class="p1 ft12">&nbsp;</P></TD>
    <TD class="tr8 td37"><P class="p1 ft12">&nbsp;</P><?php if(isset($stbId[2]) && !empty($stbId[2])) echo $stbId[2];?></TD>
    <TD class="tr8 td19"><P class="p1 ft12">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr9 td28"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td29"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td30"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td31"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td32"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td33"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td34"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td35"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td36"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td37"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td19"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr1 td38"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td39"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td40"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td22"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td23"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td41"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td42"><P class="p1 ft8">&nbsp;</P></TD>
    <TD colspan=2 class="tr1 td43"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td26"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td44"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr7 td56"><P class="p1 ft10">&nbsp;</P></TD>
    <TD class="tr7 td57"><P class="p4 ft13">Sr No.</P></TD>
    <TD colspan=2 class="tr7 td58"><P class="p1 ft10">&nbsp;</P></TD>
    <TD class="tr7 td59"><P class="p1 ft13">Box No</P></TD>
    <TD class="tr7 td60"><P class="p1 ft10 ft13">Month</P></TD>
    <TD class="tr7 td61"><P class="p1 ft10"></P></TD>
    <TD colspan=2 class="tr7 td62"><P class="p5 ft13">Pack</P></TD>
    <TD class="tr7 td63"><P class="p6 ft13">SIGN</P></TD>
    <TD class="tr7 td44"><P class="p1 ft10">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr6 td9"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td64"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td11"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td12"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td13"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td65"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td15"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td16"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td17"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td18"><P class="p1 ft9">&nbsp;</P></TD>
    <TD class="tr6 td55"><P class="p1 ft9">&nbsp;</P></TD>
</TR>
<?php
    $i=1;
    foreach($customerData['billing_info'] as $billingInfo){
?>
<TR>
    <TD class="tr9 td28"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td66"><P class="p1 ft8">&nbsp;</P><?php echo $i; ?></TD>
    <TD class="tr9 td67"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td31"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td32"><P class="p1 ft8">&nbsp;</P><?php echo $billingInfo['stb_id']; ?></TD>
    <TD class="tr9 td53"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td34"><P class="p1 ft8">&nbsp;</P><?php echo $billingInfo['month']; ?></TD>
    <TD class="tr9 td68"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td36"><P class="p1 ft8">&nbsp;</P><?php echo $billingInfo['pack']; ?></TD>
    <TD class="tr9 td37"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td55"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<?php
    $i++;
    }
?>
<TR>
    <TD class="tr9 td28"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td66"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td67"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td31"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td32"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td53"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td34"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td68"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td36"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td37"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td55"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr9 td28"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td66"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td67"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td31"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td32"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td53"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td34"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td68"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td36"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td37"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td55"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr9 td28"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td66"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td67"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td31"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td32"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td53"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td34"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td68"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td36"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td37"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td55"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr1 td28"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td66"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td67"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td31"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td32"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td53"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td34"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td68"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td36"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td37"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td55"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr9 td28"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td66"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td67"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td31"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td32"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td53"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td34"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td68"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td36"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td37"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td55"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr9 td28"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td66"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td67"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td31"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td32"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td53"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td34"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td68"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td36"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td37"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td55"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr9 td28"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td66"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td67"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td31"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td32"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td53"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td34"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td68"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td36"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td37"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td55"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr9 td28"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td66"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td67"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td31"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td32"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td53"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td34"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td68"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td36"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td37"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td55"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr9 td28"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td66"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td67"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td31"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td32"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td53"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td34"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td68"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td36"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td37"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr9 td55"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
<TR>
    <TD class="tr1 td28"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td66"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td67"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td31"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td32"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td53"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td34"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td68"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td36"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td37"><P class="p1 ft8">&nbsp;</P></TD>
    <TD class="tr1 td55"><P class="p1 ft8">&nbsp;</P></TD>
</TR>
</TABLE>
</BODY>
</HTML>