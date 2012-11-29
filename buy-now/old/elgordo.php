<?php
$xml_obj = simplexml_load_file('http://www.lotterymaster.com/lotteries-xml');
	
$free_lotteries = array('1' => array('nid' => '7625', 
									'logo' => 'images/logo/mega-millions.png', 
									'ticket' => 'images/megaCard.png', 
									'flag' => 'images/flag/flag1.png', 
									'country' => 'USA',
									'name' => 'USA - Mega Millions'),
						'2' => array('nid' => '7629', 
									'logo' => 'images/logo/superball1.png', 
									'ticket' => 'images/powerballCard.png', 
									'flag' => 'images/flag/flag1.png', 
									'country' => 'USA',
									'name' => 'USA - Powerball'),
						'3' => array('nid' => '7618', 
									'logo' => 'images/logo/superemalotto.png', 
									'ticket' => 'images/superenalottoCard.png', 
									'flag' => 'images/flag/flag4.png', 
									'country' => 'Italy',
									'name' => 'Italy - Superenalotto'),
						'4' => array('nid' => '7644', 
									'logo' => 'images/logo/el-gordo-de-al-primitiva.png', 
									'ticket' => 'images/gordoCard.png', 
									'flag' => 'images/flag/flag2.png', 
									'country' => 'Spain',
									'name' => 'Spain - El Gordo'),
						'5' => array('nid' => '7639', 
									'logo' => 'images/logo/la primitiva.png', 
									'ticket' => 'images/rimativaCard.png', 
									'flag' => 'images/flag/flag2.png', 
									'country' => 'Spain',
									'name' => 'Spain - La Primitiva'),
						'6' => array('nid' => '7633', 
									'logo' => 'images/logo/euro-millions.png', 
									'ticket' => 'images/euroCard.png', 
									'flag' => 'images/flag/flag3.png', 
									'country' => 'Europe',
									'name' => 'Europe - Euromillions'),
						'7' => array('nid' => '7669', 
									'logo' => 'images/logo/euro-jackpot.png', 
									'ticket' => 'images/eurojackpotCard.png', 
									'flag' => 'images/flag/flag3.png', 
									'country' => 'Europe',
									'name' => 'Europe - Euro jackpot'),
						'8' => array('nid' => '94957', 
									'logo' => 'images/logo/euro-millions-UK.png', 
									'ticket' => 'images/euroCard.png', 
									'flag' => 'images/flag/flag3.png', 
									'country' => 'UK',
									'name' => 'UK - UK Euromillion'),
						'9' => array('nid' => '7650', 
									'logo' => 'images/logo/the-national-lottey.png', 
									'ticket' => 'images/ukCard.png', 
									'flag' => 'images/flag/flag3.png', 
									'country' => 'UK',
									'name' => 'UK - UK National'),
						'11' => array('nid' => '120162', 
									'logo' => 'images/logo/christmas_elgordo_logo.png', 
									'ticket' => 'images/elgordo_03.png.png', 
									'flag' => 'images/flag/flag2.png', 
									'country' => 'Spain',
									'name' => 'Spain - CHRISTMAS EL GORDO'),
						);
				
$lang = 'und';	

$curr_lott = 4;


//get texts
if (isset($_REQUEST['language'])){
	$xml_obj1 = simplexml_load_file('https://www.lotterymaster.com/landing-pages-texts/buy%20now/' . $_REQUEST['language']);
	$lang = $_REQUEST['language'];
}else{
	$xml_obj1 = simplexml_load_file('https://www.lotterymaster.com/landing-pages-texts/buy%20now/trans_en');
	$lang = 'trans_en';
}
//$wintheofficial = str_replace("USA",$free_lotteries[$curr_lott]['country'],$xml_obj1->node->Phrase1);
$wintheofficial = $xml_obj1->node->Phrase1 . ' ' . $free_lotteries[$curr_lott]['country'] . ' ' . $xml_obj1->node->Phrase10;
$buylotteryonline =  $xml_obj1->node->Phrase2;
$timeleft = $xml_obj1->node->Phrase3;
$days = $xml_obj1->node->Phrase4;
$hours = $xml_obj1->node->Phrase5;
$minutes = $xml_obj1->node->Phrase6;
$secs = $xml_obj1->node->Phrase7;
$notpublished = $xml_obj1->node->Phrase8;
$getfreeficket = $xml_obj1->node->Phrase9;


foreach ($xml_obj->node as $k => $val) {
	switch ($val->LotteryID) {
		case '3'://case 'PowerBall':
			if (isset($val->Jackpot)){
				$PB_jackpot = '$ ' . number_format(str_replace(' ','',$val->Jackpot));
			}else{
				$PB_jackpot = 'Not published';
			}
			$PB_path = $val->Path;
			break;
		case '1'://case 'SuperEnalotto':
			if (isset($val->Jackpot)){
				$SE_jackpot = '&euro; ' . number_format(str_replace(' ','',$val->Jackpot));
			}else{
				$SE_jackpot = 'Not published';
			}
			$SE_path = $val->Path;
			break;
		case '6'://case 'El Gordo de la Primitiva':
			$curr = $val;
			if (isset($val->Jackpot)){
				$EGP_jackpot = '&euro; ' . number_format(str_replace(' ','',$val->Jackpot));
			}else{
				$EGP_jackpot = 'Not published';
			}
			$jackpot = $EGP_jackpot;
			$EGP_path = $val->Path;
			break;
		case '7'://case 'UK National Lotto':
			if (isset($val->Jackpot)){
				$UNL_jackpot = '&pound; ' . number_format(str_replace(' ','',$val->Jackpot));
			}else{
				$UNL_jackpot = 'Not published';
			}
			$UNL_path = $val->Path;
			break;
		case '5'://case 'La Primitiva':
			if (isset($val->Jackpot)){
				$LP_jackpot = '&euro; ' . number_format(str_replace(' ','',$val->Jackpot));
			}else{
				$LP_jackpot = 'Not published';
			}
			$LP_path = $val->Path;
			break;
		case '9'://case 'EuroJackpot':
			if (isset($val->Jackpot)){
				$EJ_jackpot = '&euro; ' . number_format(str_replace(' ','',$val->Jackpot));
			}else{
				$EJ_jackpot = 'Not published';
			}
			$EJ_path = $val->Path;
			break;
		case '18'://case 'UK EuroMillions':
			if (isset($val->Jackpot)){
				$UEM_jackpot = '&pound; ' . number_format(str_replace(' ','',$val->Jackpot));
			}else{
				$UEM_jackpot = 'Not published';
			}
			$UEM_path = $val->Path;
			break;
		case '4'://case 'Euro Millions':
			if (isset($val->Jackpot)){
				$EM_jackpot = '&euro; ' . number_format(str_replace(' ','',$val->Jackpot));
			}else{
				$EM_jackpot = 'Not published';
			}
			$EM_path = $val->Path;
			break;
		case '2'://case 'Mega Millions':
			if (isset($val->Jackpot)){
				$MM_jackpot = '$ ' . number_format(str_replace(' ','',$val->Jackpot));
			}else{
				$MM_jackpot = 'Not published';
			}
			$MM_path = $val->Path;
			break;
	}
	
}

$seconds = $curr->ClosePurchaseDate - time();
$deadLine = sprintf("%d:%02d:%02d:%02d", $seconds / 86400, ($seconds / 3600) % 24, ($seconds / 60) % 60, $seconds % 60);
$draw_path = $curr->Path;

$scripts_xml_obj = simplexml_load_file('http://www.lotterymaster.com/buy-now-top-pixels');
$top_scripts = get_object_vars($scripts_xml_obj->body->outline);
$top_scripts = str_replace("</script>","</script>\n",$top_scripts['@attributes']['text']);
$top_scripts = str_replace("~","&",$top_scripts);

$scripts_xml_obj = simplexml_load_file('http://www.lotterymaster.com/buy-now-bottom-pixels');
$bottom_scripts = get_object_vars($scripts_xml_obj->body->outline);
$bottom_scripts = str_replace("</script>","</script>\n",$bottom_scripts['@attributes']['text']);
$bottom_scripts = str_replace("~","&",$bottom_scripts);

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="icon" 
      type="image/png/ico" 
      href="http://lotterymaster.co/buy-now/favicon.ico">

<title>Landing Page | Buy Now</title>
<?php print($top_scripts);?>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery.countdown.min.js"></script>
<script type="text/javascript">
	jQuery(function(){
		jQuery('.time-default .holder').countdown({
			image: 'images/digits.png',
			format: 'hh:mm:ss',
			startTime: '<?php echo $deadLine;?>',//,<?php // echo $deadLine;?> '1:15:54:28'//Drupal.settings.lottery['lotteryDrawDeadLine'],
			//			startTime: this.title,
			digitImages: 6,
			digitWidth: 25,
			digitHeight: 31
		});
	});
</script>
  <meta charset="utf-8">
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,200,100,500,600,700' rel='stylesheet' type='text/css'>
  
  <!--[if lt IE 7]>
  	<link rel="stylesheet" href="Style/ie/ie6.css" type="text/css" media="all">
  <![endif]-->
  <!--[if lt IE 9]>
  	<script type="text/javascript" src="js/html5.js"></script>
    <script type="text/javascript" src="js/IE9.js"></script>
  <![endif]-->
</head>
<body>

    <div class="wrapper">
		<div class="wrapper">
	    
	    	<header>
	        	<div class="container"><img src="images/logo.png" alt="logo" /></div>
	        </header>
	        
	        
	        <div class="clear"></div>
	        
	        
	        <div class="midContent">
	        	<div class="container">
	            
	            	<div class="winResultRow">
	                	<div class="win">
	                       <div class="winPic">
	                            <img src="<?php print $free_lotteries[$curr_lott]['ticket'];?>" alt="Pirce Pic" />
	                            <div class="ladyPic">
					<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" data="images/woman.swf" height="438" width="272">
						<param name="wmode" value="transparent"><param name="quality" value="high">
						<param name="movie" value="images/woman.swf">
						<embed height="438" pluginspage="https://www.macromedia.com/go/getflashplayer" quality="high" src="images/woman.swf" type="application/x-shockwave-flash" width="272" wmode="transparent">
					</object>                            
	                            </div>
	                        </div>
	                    </div>
	                    <h1>
	                    <?php
							print $wintheofficial . '<br /><span>' . $buylotteryonline . '</span>';
	                    ?>
	                    </h1>
	                    
	                    <div class="resultRow">
	                    	
	                        <div class="cols1">
	                        	<img src="<?php print $free_lotteries[$curr_lott]['logo']; ?>" alt="logo" style="width: 140px;"/>
	                        </div>
	                        
	                        <div class="cols2">
	                        
	                        	<div class="top">
	                            	<div class="left"><img src="<?php print $free_lotteries[$curr_lott]['flag']; ?>" alt="flag" /></div>
	                                <div class="right"><?php print $free_lotteries[$curr_lott]['name'];?></div>
	                            </div>
	                            <div class="bottom">
	                            	<?php print $jackpot ;?>
	                            </div>
	                            
	                        </div>
	                        
	                        <div class="cols3">
					            <div class="time-left time-default label-top">
					                <span class="label"><?= $timeleft ?></span>
									<div class="holder" style="height: 31px; overflow: hidden; "title="<?php echo $deadLine ?>"></div>
					                <div id="counter"></div>
					                <div class="desc">
					                    <div><?= $days ?></div>
					                    <div><?= $hours ?></div>
					                    <div><?= $minutes ?></div>
					                    <div><?= $secs ?></div>
					                </div>
					            </div>
	                        
	                            <div class="btmRow">
	                            	<a href="/buy-now/loading.php?lotterymaster_dest=<?php print $draw_path; ?>&language=<?php print $lang; ?>"><?php print $getfreeficket; ?> &raquo;</a>
	                            </div>
	                        
	                        </div>
	                        
	                    </div>
	                    
	                </div>
	                <div class="bottomLogo">
	                    <ul>
							<li class="left1">
								<div class="logo"><img src="images/logo/superemalotto.png" alt="logo" style="width:140px"/></div>
								<div class="textRow">
									Official Spanish Lottery <br />
									<span>SuperEnalotto</span>
								</div>
								<div class="priceNum"><?PHP print $SE_jackpot;?></div>
								<div class="playNow"><a href="http://www.lotterymaster.com/<?PHP print $SE_path;?>">Play Now »</a></div>
							</li>
							
							<li class="left1">
								<div class="logo"><img src="images/logo/the-national-lottey.png" alt="logo" style="width:140px"/></div>
								<div class="textRow">
									Official UK Lottery <br />
									<span>The National Lottery</span>
								</div>
								<div class="priceNum"><?PHP print $UNL_jackpot;?></div>
								<div class="playNow"><a href="http://www.lotterymaster.com/<?PHP print $UNL_path;?>">Play Now »</a></div>
							</li>							
							<li class="left1">
								<div class="logo"><img src="images/logo/mega-millions.png" alt="logo" style="width:140px"/></div>
								<div class="textRow">
									Official USA Lottery <br />
									<span>Mega Millions</span>
								</div>
								<div class="priceNum"><?PHP print $MM_jackpot;?></div>
								<div class="playNow"><a href="http://www.lotterymaster.com/<?PHP print $MM_path;?>">Play Now »</a></div>
							</li>
							
							<li class="left1">
								<div class="logo"><img src="images/logo/superball1.png" alt="logo" style="width:140px"/></div>
								<div class="textRow">
									Official USA Lottery <br />
									<span>Superball</span>
								</div>
								<div class="priceNum"><?PHP print $PB_jackpot;?></div>
								<div class="playNow"><a href="http://www.lotterymaster.com/<?PHP print $PB_path;?>">Play Now »</a></div>
							</li>
							
							<li class="left1">
								<div class="logo"><img src="images/logo/la primitiva.png" alt="logo" style="width:140px"/></div>
								<div class="textRow">
									Official Spanish Lottery <br />
									<span>La Primitiva</span>
								</div>
								<div class="priceNum"><?PHP print $LP_jackpot;?></div>
								<div class="playNow"><a href="http://www.lotterymaster.com/<?PHP print $LP_path;?>">Play Now »</a></div>
							</li>
	                    </ul>
	                </div>
	            
	            </div>
	            <div class="clear"></div>
	        </div>
	        
	        
	        
	        
	        
	        <footer>
	        	<?php print 'Lottery Master Enterprises Limited and its associated brands operate an independent ticket purchasing service and are neither affiliated with nor endorsed by <br />
	official lottery organizations. International (PCT) Patent Pending Copyrights &copy; Trainspotting Limited 1999-2012 all rights reserved.'; ?>
<?php print($top_scripts);?>
	        </footer>
	        <div class="clear"></div>
	        
	    </div>
