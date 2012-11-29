<?php
//phpinfo(); //i had to install some ssh dll in the php.ini in order for this to work
$xml_obj = simplexml_load_file('http://www.lotterymaster.com/lotteries-xml');
//print_r($xml_obj);
if (isset($_SERVER['HTTP_REFERER'])){
	$referer = $_SERVER['HTTP_REFERER'];
}else{
	$referer = '';
}
//get texts
if (isset($_REQUEST['language'])){
	$xml_obj1 = simplexml_load_file('https://www.lotterymaster.com/landing-pages-texts/free%20lottery%20powerball/' . $_REQUEST['language']);
	$lang = $_REQUEST['language'];
}else{
	$xml_obj1 = simplexml_load_file('https://www.lotterymaster.com/landing-pages-texts/free%20lottery%20powerball/en');
	$lang = 'en';
}
//$Get2free = str_replace("Euro Jackpot","PowerBall",$xml_obj1->node->Phrase1);
$Get2free = $xml_obj1->node->Phrase1;
$Wehavealready =  $xml_obj1->node->Phrase2;
$Leaveyourphone = $xml_obj1->node->Phrase3;
$Name = $xml_obj1->node->Phrase4;
$Country = $xml_obj1->node->Phrase5;
$Selectcountry = $xml_obj1->node->Phrase6;
$PhoneNumber = $xml_obj1->node->Phrase7;
$Official = $xml_obj1->node->Phrase8;
$GetFreeTicket = $xml_obj1->node->Phrase9;
/*}else{
	$Get2free = 'Get 2 free tickets for the next PowerBall';
	$Wehavealready = 'We have already handed out over 55,000,000 in prizes';
	$Leaveyourphone = 'Leave your phone number to get your FREE lottery ticket';
	$Name = 'Name';
	$Country = 'Country';
	$Selectcountry = 'Select country';
	$PhoneNumber = 'Phone Number';
	$Official = 'Official';
	$GetFreeTicket = 'GET YOUR FREE TICKET';
}*/

$PB_jackpot = 'Not published';
$SE_jackpot = 'Not published';
$EGP_jackpot = 'Not published';
$UNL_jackpot = 'Not published';
$LP_jackpot = 'Not published';
$EJ_jackpot = 'Not published';
$UEM_jackpot = 'Not published';
$EM_jackpot = 'Not published';
$MM_jackpot = 'Not published';
$draw_path = 'superenalotto-lottery';
//$draw_path = '';

foreach ($xml_obj->node as $k => $val) {
//debug1($val->LotteryID);
//$tit = trim($val->title);
	if (isset($val->Jackpot)){
		$jackpot = number_format(str_replace(' ','',$val->Jackpot));
	}
	switch ($val->LotteryID) {
		//case 'PowerBall':
		case '3':
			$PB = $k;
			if (isset($val->Jackpot)){
				$PB_jackpot = '$ ' . $jackpot;
			}else{
				$PB_jackpot = 'Not published';
			}
			$draw_path = $val->Path;
			break;
		//case 'SuperEnalotto':
		case '1':
			$SE = $k;
			if (isset($val->Jackpot)){
				$SE_jackpot = '&euro; ' . $jackpot;
			}else{
				$SE_jackpot = 'Not published';
			}
			break;
		//case 'El Gordo de la Primitiva':
		case '6':
			$EGP = $k;
			if (isset($val->Jackpot)){
				$EGP_jackpot = '&euro; ' . $jackpot;
			}else{
				$EGP_jackpot = 'Not published';
			}
			break;
		//case 'UK National Lotto':
		case '7':
			$UNL = $k;
			if (isset($val->Jackpot)){
				$UNL_jackpot = '&pound; ' . $jackpot;
			}else{
				$UNL_jackpot = 'Not published';
			}
			break;
		//case 'La Primitiva':
		case '5':
			$LP = $k;
			if (isset($val->Jackpot)){
				$LP_jackpot = '&euro; ' . $jackpot;
			}else{
				$LP_jackpot = 'Not published';
			}
			break;
		//case 'EuroJackpot':
		case '9':
			$EJ = $k;
			if (isset($val->Jackpot)){
				$EJ_jackpot = '&euro; ' . $jackpot;
			}else{
				$EJ_jackpot = 'Not published';
			}
			break;
		//case 'UK EuroMillions':
		case '18':
			$UEM = $k;
			if (isset($val->Jackpot)){
				$UEM_jackpot = '&pound; ' . $jackpot;
			}else{
				$UEM_jackpot = 'Not published';
			}
			break;
		//case 'Euro Millions':
		case '4':
			$EM = $k;
			if (isset($val->Jackpot)){
				$EM_jackpot = '&euro; ' . $jackpot;
			}else{
				$EM_jackpot = 'Not published';
			}
			break;
		//case 'Mega Millions':
		case '2':
			$MM = $k;
			if (isset($val->Jackpot)){
				$MM_jackpot = '$ ' . $jackpot;
			}else{
				$MM_jackpot = 'Not published';
			}
			break;
	}
}

$scripts_xml_obj = simplexml_load_file('http://www.lotterymaster.com/free-lottery-top-pixels');
$top_scripts = get_object_vars($scripts_xml_obj->body->outline);
$top_scripts = str_replace("</script>","</script>\n",$top_scripts['@attributes']['text']);
$top_scripts = str_replace("~","&",$top_scripts);

$scripts_xml_obj = simplexml_load_file('http://www.lotterymaster.com/free-lottery-bottom-pixels');
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
      href="http://lotterymaster.co/free-lottery/favicon.ico">

<title>Lottery</title>
<?php print($top_scripts);?>
<script>
function validateForm()
{
var x=document.forms["myF"]["name"].value;
if (x==null || x=="")
  {
  alert("Name must be filled out.");
  return false;
  }
if (x.length < 3)
  {
  alert("Name must have more than 2 chars.");
  return false;
  }
var x=document.forms["myF"]["Phone"].value;
if (x==null || x=="")
  {
  alert("Phone must be filled out.");
  return false;
  }
if (!isNumeric(x))
  {
  alert("Phone must be numeric.");
  return false;
  }
if (x.length < 5)
  {
  alert("Phone must have more than 4 digits.");
  return false;
  }
var x=document.forms["myF"]["country_id"].value;
if (x==null || x=="")
  {
  alert("Country must be filled out.");
  return false;
  }
  
}
function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
</script>
</head>
<body>
<div class="container">
	<div class="wrap_all">
		<h1><?PHP print $Get2free; ?></h1>
		<h2 class="h2_power">Power ball</h2>
		<div class="wrap_price"> 
			<p><?php print $PB_jackpot; ?></p>
			<span><?PHP print $Wehavealready; ?></span>
		</div>
		<div class="hold_form">
			<form name="myF" action="/free-lottery/loading.php" method="post" autocomplete="on" onsubmit="return validateForm();">
				<div class="form_details">
					<p><?PHP print $Leaveyourphone; ?></p>
					<div class="wrap_label">	
						<label><?PHP print $Name; ?></label>
						<input type="text" name="name">
						<label><?PHP print $Country; ?></label>
						<div class="selecthold">
							<select name="country_id" id="country_id" tabindex="1">
								<option value=""><?PHP print $Selectcountry; ?></option>
								<option value="USA">USA</option>
								<option value="Canada">Canada</option>
								<option value="France">France</option>
								<option value="Spain">Spain</option>
								<option value="Bulgaria">Bulgaria</option>
								<option value="Greece">Greece</option>
								<option value="Italy">Italy</option>
								<option value="Japan">Japan</option>
								<option value="China">China</option>
								<option value="Brazil">Brazil</option>
								<option value="South Africa">South Africa</option>
							</select>
						</div>
						<label><?PHP print $PhoneNumber; ?></label>
						<input name="Phone" autocomplete="on"><br>
					</div>
					<input id="submit" type="submit" value="<?PHP print $GetFreeTicket; ?>">
				</div>
						<input type="hidden" name="referer" value="<?PHP print $referer; ?>">
						<input type="hidden" name="popupate_webform" value="On">
						<input type="hidden" name="lotterymaster_dest" value="http://www.lotterymaster.com<?php print $draw_path; ?>">
						<input type="hidden" name="language" value="<?php print $lang; ?>">
			</form>
		</div>
		<div class="footer footerposition">
			<div class="footer_logo">
				<img src="images/gordo.png" width="73" class="El_Condo" alt="EL GORDO"/>
				<p><?PHP print $Official; ?> Spanish Lottery<span>EL GORDO</span></p>
				<strong><?PHP print $EGP_jackpot;?></strong>
			</div>
			<div class="footer_logo">
				<img src="images/superenlotto.png" width="90" height="23" class="Super_Enalotto" alt="SUPERENALOTTO"/>
				<p><?PHP print $Official; ?> Italy Lottery<span>SUPERENALOTTO</span></p>
				<strong><?PHP print $SE_jackpot;?></strong>
			</div>
			<div class="footer_logo">
			<img src="images/national.png" width="37" height="37" class="blue_logo" alt="THE NATIONAL LOTTERY"/>
				<p><?PHP print $Official; ?> UK Lottery<span>THE NATIONAL LOTTERY</span></p>
				<strong><?PHP print $UNL_jackpot;?></strong>
			</div>
			<div class="footer_logo">
			<img src="images/euro.png" width="55" height="33" class="Edro_millions" alt="EURO MILLIONS"/>
				<p><?PHP print $Official; ?> Europe Lottery<span>EURO MILLIONS</span></p>
				<strong><?PHP print $EM_jackpot;?></strong>
			</div>
			<div class="footer_logo">
			<img src="images/mega_million.png" width="64" height="32" class="Mega_Million" alt="MEGA MILLIONS"/>
				<p><?PHP print $Official; ?> USA Lottery<span>MEGA MILLIONS</span></p>
				<strong><?PHP print $MM_jackpot;?></strong>
			</div>
			<div class="footer_logo">
				<img src="images/power.png" width="84" height="18" class="Power_Ball" alt="SUPERBALL"/>
				<p><?PHP print $Official; ?> USA Lottery<span>SUPERBALL</span></p>
				<strong><?PHP print $PB_jackpot;?></strong>
			</div>
			<div class="footer_logo">
				<img src="images/eurojackpot.png" width="62" class="EuroJackpot" alt="EuroJackpot"/>
				<p><?PHP print $Official; ?> Europe Lottery<span>EuroJackpot</span></p>
				<strong><?PHP print $EJ_jackpot;?></strong>
			</div>
		</div>
	</div>
</div>
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.selectbox-0.2.js"></script>
		<script type="text/javascript">
		$(function () {
			$("#country_id").selectbox();
		});
		</script>
<?php print($bottom_scripts);?>		
</body>
</html>