<?php

$scripts_xml_obj = simplexml_load_file('http://www.lotterymaster.com/free-lottery-top-pixels');
$top_scripts = get_object_vars($scripts_xml_obj->body->outline);
$top_scripts = str_replace("</script>","</script>\n",$top_scripts['@attributes']['text']);
$top_scripts = str_replace("~","&",$top_scripts);

$scripts_xml_obj = simplexml_load_file('http://www.lotterymaster.com/free-lottery-bottom-pixels');
$bottom_scripts = get_object_vars($scripts_xml_obj->body->outline);
$bottom_scripts = str_replace("</script>","</script>\n",$bottom_scripts['@attributes']['text']);
$bottom_scripts = str_replace("~","&",$bottom_scripts);

//get texts
if ($_REQUEST['language'] == 'trans_en'){
$xml_obj1 = simplexml_load_file('https://www.lotterymaster.com/landing-pages-texts/free%20lottery%20middle/en');
}else{
$xml_obj1 = simplexml_load_file('https://www.lotterymaster.com/landing-pages-texts/free%20lottery%20middle/' . $_REQUEST['language']);
}
$Getready = str_replace("Euro Jackpot","UK EuroMillions",$xml_obj1->node->Phrase1);
$LotteryMaster =  $xml_obj1->node->Phrase2;
$Getready2 = $xml_obj1->node->Phrase3;
$Andget2 = $xml_obj1->node->Phrase4;
$ifyouare = $xml_obj1->node->Phrase5;
/*}else{
	$Getready = 'Get ready to play';
	$LotteryMaster = 'Lottery Master';
	$Leaveyourphone = 'Get ready to play  at Lotterymaster';
	$Getready2 = 'And get 2$ for FREE';
	$ifyouare = 'if you are not redirect in 5 seconds please click here';
}*/
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title><?PHP print $Getready; ?></title>
<link rel="stylesheet" type="text/css" href="css/reset1.css"/>
<link rel="stylesheet" type="text/css" href="css/style1.css"/>
<link rel="icon" 
      type="image/png/ico" 
      href="http://lotterymaster.co/free-lottery/favicon.ico">

<?php print($top_scripts);?>
<script language="javascript">
setTimeout("window.location.href ='<?php print $_REQUEST['lotterymaster_dest']?>'",5000);
</script>
</head>
<body>
<div class="container">
	<div class="wrapcontent">
		<h1><?PHP print $LotteryMaster; ?></h1>
		<p><?PHP print $Getready2; ?></p>
		<span><?PHP print $Andget2; ?></span>
	<div class="bullets">	
		<div id="block_1" class="barlittle"></div>
		<div id="block_2" class="barlittle"></div>
		<div id="block_3" class="barlittle"></div>
		<div id="block_4" class="barlittle"></div>
		<div id="block_5" class="barlittle"></div>
	</div>
		<a href="<?php print $_REQUEST['lotterymaster_dest']?>"><?PHP print $ifyouare; ?></a>
	</div>
</div>
<?php print($bottom_scripts);?>		
</body>
</html>