<?php

$scripts_xml_obj = simplexml_load_file('http://www.lotterymaster.com/buy-now-top-pixels');
$top_scripts = get_object_vars($scripts_xml_obj->body->outline);
$top_scripts = str_replace("</script>","</script>\n",$top_scripts['@attributes']['text']);
$top_scripts = str_replace("~","&",$top_scripts);

$scripts_xml_obj = simplexml_load_file('http://www.lotterymaster.com/buy-now-bottom-pixels');
$bottom_scripts = get_object_vars($scripts_xml_obj->body->outline);
$bottom_scripts = str_replace("</script>","</script>\n",$bottom_scripts['@attributes']['text']);
$bottom_scripts = str_replace("~","&",$bottom_scripts);

//get texts
//if (isset($_REQUEST['language'])){
if ($_REQUEST['language'] == 'trans_en'){
$xml_obj1 = simplexml_load_file('https://www.lotterymaster.com/landing-pages-texts/buy%20now%20middle/en');
}else{
$xml_obj1 = simplexml_load_file('https://www.lotterymaster.com/landing-pages-texts/buy%20now%20middle/' . $_REQUEST['language']);
}
//$Getready = str_replace("Euro Jackpot","UK EuroMillions",$xml_obj1->node->Phrase1);
$getfree = $xml_obj1->node->Phrase1;
$lotterymaster =  $xml_obj1->node->Phrase2;
$getready2 = $xml_obj1->node->Phrase3;
$getfree2 = $xml_obj1->node->Phrase4;
$rightafter = $xml_obj1->node->Phrase5;
$ifyouare = $xml_obj1->node->Phrase6;
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
<title><?PHP print $getfree; ?></title>
<link rel="stylesheet" type="text/css" href="css/reset1.css"/>
<link rel="stylesheet" type="text/css" href="css/style1.css"/>
<link rel="icon" 
      type="image/png/ico" 
      href="http://lotterymaster.co/buy-now/favicon.ico">

<?php print($top_scripts);?>
  <!--[if lt IE 7]>
  	<link rel="stylesheet" href="ie/ie6.css" type="text/css" media="all">
  <![endif]-->
  <!--[if lt IE 9]>
  	<script type="text/javascript" src="js/html5.js"></script>
    <script type="text/javascript" src="js/IE9.js"></script>
  <![endif]-->
  
<script language="javascript">
setTimeout("window.location.href ='http://www.lotterymaster.com<?php print $_REQUEST['lotterymaster_dest']?>'",5000);
</script>
</head>
<body>
<div class="container">
	<div class="wrapcontent2">
		<h1><?php print $lotterymaster;?></h1>
		<p><?php print $getready2 . '<strong>' . $getfree2 . '</strong><span>' . $rightafter . '</span>' ;   //t('Get ready to play  at Lotterymaster and <strong>get a free lottery ticket</strong><span>right after your first purchase</span>');?></p>
		<div class="bullets">	
			<div id="block_1" class="barlittle"></div>
			<div id="block_2" class="barlittle"></div>
			<div id="block_3" class="barlittle"></div>
			<div id="block_4" class="barlittle"></div>
			<div id="block_5" class="barlittle"></div>
		</div>
		<a href="http://www.lotterymaster.com<?php print $_REQUEST['lotterymaster_dest'];?>"><?php print $ifyouare ;?></a>
	</div>
</div>
<?php print($bottom_scripts);?>		
</body>
</html>