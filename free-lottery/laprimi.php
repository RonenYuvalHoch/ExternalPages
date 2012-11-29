<?php
//phpinfo(); //i had to install some ssh dll in the php.ini in order for this to work
$xml_obj = simplexml_load_file('http://www.lotterymaster.com/lotteries-xml');
//print_r ($xml_obj);
if (isset($_SERVER['HTTP_REFERER'])){
	$referer = $_SERVER['HTTP_REFERER'];
}else{
	$referer = '';
}

//get texts
if (isset($_REQUEST['language'])){
	$xml_obj1 = simplexml_load_file('https://www.lotterymaster.com/landing-pages-texts/free%20lottery%20LaPrimitiva/' . $_REQUEST['language']);
	$lang = $_REQUEST['language'];
}else{
	$xml_obj1 = simplexml_load_file('https://www.lotterymaster.com/landing-pages-texts/free%20lottery%20LaPrimitiva/en');
	$lang = 'en';
}
//$Get2free = str_replace("Euro Jackpot","La Primitiva",$xml_obj1->node->Phrase1);
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
	$Get2free = 'Get 2 free tickets for the next La Primitiva';
	$Wehavealready = 'We have already handed out over 55,000,000 in prizes';
	$Leaveyourphone = 'Leave your phone number to get your FREE lottery ticket';
	$Name = 'Name';
	$Country = 'Country';
	$Selectcountry = 'Select country';
	$PhoneNumber = 'Phone Number';
	$Official = 'Official';
	$GetFreeTicket = 'GET YOUR FREE TICKET';
}
*/
/*
if (isset($_REQUEST['language'])){
	switch ($_REQUEST['language']) {
		case 'en':
			$Get2free = 'Get 2 free tickets for the next La Primitiva lottery';
			$Wehavealready = 'We have already handed out over 55,000,000 in prizes';
			$Leaveyourphone = 'Leave your phone number to get your FREE lottery ticket';
			$Name = 'Name';
			$Country = 'Country';
			$Selectcountry = 'Select country';
			$PhoneNumber = 'Phone Number';
			$Official = 'Official';
			$GetFreeTicket = 'GET YOUR FREE TICKET';
			break;
		case 'it':
			$Get2free = 'Prendi 2 biglietti gratuiti per la prossima lotteria (La Primitiva)';
			$Wehavealready = 'Abbiamo gi? dato oltre 55.000.000 Euro in premi';
			$Leaveyourphone = 'Dacci il tuo numero telefonico e otterrai il tuo biglietto della lotteria GRATIS';
			$Name = 'Nome';
			$Country = 'Nazione';
			$Selectcountry = 'Select country';
			$PhoneNumber = 'Telefono';
			$Official = 'Official';
			$GetFreeTicket = 'BIGLIETTO GRATIS';
			break;
		case 'du':
			$Get2free = 'Krijg 2 gratis loten voor de volgende (La Primitiva)-loterij';
			$Wehavealready = 'We hebben al meer dan 55.000.000 aan prijzen uitgedeeld';
			$Leaveyourphone = 'We hebben al meer dan 55.000.000 aan prijzen uitgedeeld';
			$Name = 'Naam';
			$Country = 'Land';
			$Selectcountry = 'Select country';
			$PhoneNumber = 'Telefoonnummer';
			$Official = 'Official';
			$GetFreeTicket = 'ONTVANG JOUW GRATIS LOT';
			break;
		case 'ge':
			$Get2free = 'Erhalten Sie 2 Gratis-Lose f?r die n?chste (La Primitiva) Lotterie';
			$Wehavealready = 'Wir haben bereits ?ber 55.000.000 Preise vergeben';
			$Leaveyourphone = 'Hinterlassen Sie Ihre Telefonnummer, um Ihr GRATIS-Lotterielos zu erhalten';
			$Name = 'Name';
			$Country = 'Land';
			$Selectcountry = 'frSelect country';
			$PhoneNumber = 'Telefonnummer';
			$Official = 'Official';
			$GetFreeTicket = 'ERHALTEN SIE IHR GRATIS-LOS';
			break;
		case 'ru':
			$Get2free = 'Получите 2 бесплатных билета на следующий розыгрыш лотереи (La Primitiva) ';
			$Wehavealready = 'Мы уже выдали более 55 миллионов призовых';
			$Leaveyourphone = 'Чтобы получить БЕСПЛАТНЫЙ билет, укажите свой номер телефона';
			$Name = 'Имя';
			$Country = 'Страна';
			$Selectcountry = 'Select country';
			$PhoneNumber = 'Номер телефона';
			$Official = 'Official';
			$GetFreeTicket = 'ПОЛУЧИТЕ СВОЙ БЕСПЛАТНЫЙ БИЛЕТ';
			break;
		case 'fr':
			$Get2free = 'Recevez 2 tickets gratuits pour le prochain tirage de l\'La Primitiva';
			$Wehavealready = 'Nous avons déjà distribué plus de 55 000 000 de prix';
			$Leaveyourphone = 'Indiquez votre numéro de téléphone pour obtenir votre ticket de loterie GRATUIT';
			$Name = 'Nom';
			$Country = 'Pays';
			$Selectcountry = 'Select country';
			$PhoneNumber = 'Numéro de téléphone';
			$Official = 'Official';
			$GetFreeTicket = 'OBTENEZ VOTRE TICKET GRATUIT';
			break;
		case 'es':
			$Get2free = 'Consiga 2 boletos gratis para el siguiente sorteo de (La Primitiva)';
			$Wehavealready = 'Ya hemos entregado más de 55 000 000 en premios';
			$Leaveyourphone = 'Deje su número de teléfono para conseguir nuestro boleto de lotería GRATIS';
			$Name = 'Nombre';
			$Country = 'País';
			$Selectcountry = 'Select country';
			$PhoneNumber = 'Número de teléfono';
			$Official = 'Official';
			$GetFreeTicket = 'CONSIGA SU BOLETO GRATIS';
			break;
	}
}
*/
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
			$draw_path = $val->Path;
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
//print_r($scripts_xml_obj);
/*
$pixels = '';
for ($i=0;$i < count($scripts); $i++){
	if ( is_object($scripts[$i])){
		//print 'k' . get_object_vars($pixel) . 'k';
		//print_r (get_object_vars($pixel));
		$arr_scr = get_object_vars($scripts[$i]);
		//print_r ($arr_scr);
		//$pixels .= '<script type="text/javascript" scr="' . $arr_scr['@attributes']['src']. '"></script>' . "\n";
	}else{
		$pixels .= '<script type="text/javascript">' . $scripts[$i] . '</script>' . "\n";
	}
}*/
/*foreach ($scripts_xml_obj->node->Body->script as $pixel){
	if ( is_object($pixel)){
		//print 'k' . get_object_vars($pixel) . 'k';
		print_r (get_object_vars($pixel));
		//$pixels .= 'obj';
	}else{
		$pixels .= '<script type="text/javascript">' . $pixel . '</script>' . "\n";
	}
}
*/
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
		<h2 class="h2_Primi">La Primitiva</h2>
		<div class="wrap_price"> 
			<p><?php print $LP_jackpot; ?></p>
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
								<option value="Afganistan">Afghanistan</option>
								<option value="Albania">Albania</option>
								<option value="Algeria">Algeria</option>
								<option value="American Samoa">American Samoa</option>
								<option value="Andorra">Andorra</option>
								<option value="Angola">Angola</option>
								<option value="Anguilla">Anguilla</option>
								<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
								<option value="Argentina">Argentina</option>
								<option value="Armenia">Armenia</option>
								<option value="Aruba">Aruba</option>
								<option value="Australia">Australia</option>
								<option value="Austria">Austria</option>
								<option value="Azerbaijan">Azerbaijan</option>
								<option value="Bahamas">Bahamas</option>
								<option value="Bahrain">Bahrain</option>
								<option value="Bangladesh">Bangladesh</option>
								<option value="Barbados">Barbados</option>
								<option value="Belarus">Belarus</option>
								<option value="Belgium">Belgium</option>
								<option value="Belize">Belize</option>
								<option value="Benin">Benin</option>
								<option value="Bermuda">Bermuda</option>
								<option value="Bhutan">Bhutan</option>
								<option value="Bolivia">Bolivia</option>
								<option value="Bonaire">Bonaire</option>
								<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
								<option value="Botswana">Botswana</option>
								<option value="Brazil">Brazil</option>
								<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
								<option value="Brunei">Brunei</option>
								<option value="Bulgaria">Bulgaria</option>
								<option value="Burkina Faso">Burkina Faso</option>
								<option value="Burundi">Burundi</option>
								<option value="Cambodia">Cambodia</option>
								<option value="Cameroon">Cameroon</option>
								<option value="Canada">Canada</option>
								<option value="Canary Islands">Canary Islands</option>
								<option value="Cape Verde">Cape Verde</option>
								<option value="Cayman Islands">Cayman Islands</option>
								<option value="Central African Republic">Central African Republic</option>
								<option value="Chad">Chad</option>
								<option value="Channel Islands">Channel Islands</option>
								<option value="Chile">Chile</option>
								<option value="China">China</option>
								<option value="Christmas Island">Christmas Island</option>
								<option value="Cocos Island">Cocos Island</option>
								<option value="Colombia">Colombia</option>
								<option value="Comoros">Comoros</option>
								<option value="Congo">Congo</option>
								<option value="Cook Islands">Cook Islands</option>
								<option value="Costa Rica">Costa Rica</option>
								<option value="Cote DIvoire">Cote D'Ivoire</option>
								<option value="Croatia">Croatia</option>
								<option value="Cuba">Cuba</option>
								<option value="Curaco">Curacao</option>
								<option value="Cyprus">Cyprus</option>
								<option value="Czech Republic">Czech Republic</option>
								<option value="Denmark">Denmark</option>
								<option value="Djibouti">Djibouti</option>
								<option value="Dominica">Dominica</option>
								<option value="Dominican Republic">Dominican Republic</option>
								<option value="East Timor">East Timor</option>
								<option value="Ecuador">Ecuador</option>
								<option value="Egypt">Egypt</option>
								<option value="El Salvador">El Salvador</option>
								<option value="Equatorial Guinea">Equatorial Guinea</option>
								<option value="Eritrea">Eritrea</option>
								<option value="Estonia">Estonia</option>
								<option value="Ethiopia">Ethiopia</option>
								<option value="Falkland Islands">Falkland Islands</option>
								<option value="Faroe Islands">Faroe Islands</option>
								<option value="Fiji">Fiji</option>
								<option value="Finland">Finland</option>
								<option value="France">France</option>
								<option value="French Guiana">French Guiana</option>
								<option value="French Polynesia">French Polynesia</option>
								<option value="French Southern Ter">French Southern Ter</option>
								<option value="Gabon">Gabon</option>
								<option value="Gambia">Gambia</option>
								<option value="Georgia">Georgia</option>
								<option value="Germany">Germany</option>
								<option value="Ghana">Ghana</option>
								<option value="Gibraltar">Gibraltar</option>
								<option value="Great Britain">Great Britain</option>
								<option value="Greece">Greece</option>
								<option value="Greenland">Greenland</option>
								<option value="Grenada">Grenada</option>
								<option value="Guadeloupe">Guadeloupe</option>
								<option value="Guam">Guam</option>
								<option value="Guatemala">Guatemala</option>
								<option value="Guinea">Guinea</option>
								<option value="Guyana">Guyana</option>
								<option value="Haiti">Haiti</option>
								<option value="Hawaii">Hawaii</option>
								<option value="Honduras">Honduras</option>
								<option value="Hong Kong">Hong Kong</option>
								<option value="Hungary">Hungary</option>
								<option value="Iceland">Iceland</option>
								<option value="India">India</option>
								<option value="Indonesia">Indonesia</option>
								<option value="Iran">Iran</option>
								<option value="Iraq">Iraq</option>
								<option value="Ireland">Ireland</option>
								<option value="Isle of Man">Isle of Man</option>
								<option value="Israel">Israel</option>
								<option value="Italy">Italy</option>
								<option value="Jamaica">Jamaica</option>
								<option value="Japan">Japan</option>
								<option value="Jordan">Jordan</option>
								<option value="Kazakhstan">Kazakhstan</option>
								<option value="Kenya">Kenya</option>
								<option value="Kiribati">Kiribati</option>
								<option value="Korea North">Korea North</option>
								<option value="Korea Sout">Korea South</option>
								<option value="Kuwait">Kuwait</option>
								<option value="Kyrgyzstan">Kyrgyzstan</option>
								<option value="Laos">Laos</option>
								<option value="Latvia">Latvia</option>
								<option value="Lebanon">Lebanon</option>
								<option value="Lesotho">Lesotho</option>
								<option value="Liberia">Liberia</option>
								<option value="Libya">Libya</option>
								<option value="Liechtenstein">Liechtenstein</option>
								<option value="Lithuania">Lithuania</option>
								<option value="Luxembourg">Luxembourg</option>
								<option value="Macau">Macau</option>
								<option value="Macedonia">Macedonia</option>
								<option value="Madagascar">Madagascar</option>
								<option value="Malaysia">Malaysia</option>
								<option value="Malawi">Malawi</option>
								<option value="Maldives">Maldives</option>
								<option value="Mali">Mali</option>
								<option value="Malta">Malta</option>
								<option value="Marshall Islands">Marshall Islands</option>
								<option value="Martinique">Martinique</option>
								<option value="Mauritania">Mauritania</option>
								<option value="Mauritius">Mauritius</option>
								<option value="Mayotte">Mayotte</option>
								<option value="Mexico">Mexico</option>
								<option value="Midway Islands">Midway Islands</option>
								<option value="Moldova">Moldova</option>
								<option value="Monaco">Monaco</option>
								<option value="Mongolia">Mongolia</option>
								<option value="Montserrat">Montserrat</option>
								<option value="Morocco">Morocco</option>
								<option value="Mozambique">Mozambique</option>
								<option value="Myanmar">Myanmar</option>
								<option value="Nambia">Nambia</option>
								<option value="Nauru">Nauru</option>
								<option value="Nepal">Nepal</option>
								<option value="Netherland Antilles">Netherland Antilles</option>
								<option value="Netherlands">Netherlands (Holland, Europe)</option>
								<option value="Nevis">Nevis</option>
								<option value="New Caledonia">New Caledonia</option>
								<option value="New Zealand">New Zealand</option>
								<option value="Nicaragua">Nicaragua</option>
								<option value="Niger">Niger</option>
								<option value="Nigeria">Nigeria</option>
								<option value="Niue">Niue</option>
								<option value="Norfolk Island">Norfolk Island</option>
								<option value="Norway">Norway</option>
								<option value="Oman">Oman</option>
								<option value="Pakistan">Pakistan</option>
								<option value="Palau Island">Palau Island</option>
								<option value="Palestine">Palestine</option>
								<option value="Panama">Panama</option>
								<option value="Papua New Guinea">Papua New Guinea</option>
								<option value="Paraguay">Paraguay</option>
								<option value="Peru">Peru</option>
								<option value="Phillipines">Philippines</option>
								<option value="Pitcairn Island">Pitcairn Island</option>
								<option value="Poland">Poland</option>
								<option value="Portugal">Portugal</option>
								<option value="Puerto Rico">Puerto Rico</option>
								<option value="Qatar">Qatar</option>
								<option value="Republic of Montenegro">Republic of Montenegro</option>
								<option value="Republic of Serbia">Republic of Serbia</option>
								<option value="Reunion">Reunion</option>
								<option value="Romania">Romania</option>
								<option value="Russia">Russia</option>
								<option value="Rwanda">Rwanda</option>
								<option value="St Barthelemy">St Barthelemy</option>
								<option value="St Eustatius">St Eustatius</option>
								<option value="St Helena">St Helena</option>
								<option value="St Kitts-Nevis">St Kitts-Nevis</option>
								<option value="St Lucia">St Lucia</option>
								<option value="St Maarten">St Maarten</option>
								<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
								<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
								<option value="Saipan">Saipan</option>
								<option value="Samoa">Samoa</option>
								<option value="Samoa American">Samoa American</option>
								<option value="San Marino">San Marino</option>
								<option value="Sao Tome & Principe">Sao Tome &amp; Principe</option>
								<option value="Saudi Arabia">Saudi Arabia</option>
								<option value="Senegal">Senegal</option>
								<option value="Seychelles">Seychelles</option>
								<option value="Sierra Leone">Sierra Leone</option>
								<option value="Singapore">Singapore</option>
								<option value="Slovakia">Slovakia</option>
								<option value="Slovenia">Slovenia</option>
								<option value="Solomon Islands">Solomon Islands</option>
								<option value="Somalia">Somalia</option>
								<option value="South Africa">South Africa</option>
								<option value="Spain">Spain</option>
								<option value="Sri Lanka">Sri Lanka</option>
								<option value="Sudan">Sudan</option>
								<option value="Suriname">Suriname</option>
								<option value="Swaziland">Swaziland</option>
								<option value="Sweden">Sweden</option>
								<option value="Switzerland">Switzerland</option>
								<option value="Syria">Syria</option>
								<option value="Tahiti">Tahiti</option>
								<option value="Taiwan">Taiwan</option>
								<option value="Tajikistan">Tajikistan</option>
								<option value="Tanzania">Tanzania</option>
								<option value="Thailand">Thailand</option>
								<option value="Togo">Togo</option>
								<option value="Tokelau">Tokelau</option>
								<option value="Tonga">Tonga</option>
								<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
								<option value="Tunisia">Tunisia</option>
								<option value="Turkey">Turkey</option>
								<option value="Turkmenistan">Turkmenistan</option>
								<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
								<option value="Tuvalu">Tuvalu</option>
								<option value="Uganda">Uganda</option>
								<option value="Ukraine">Ukraine</option>
								<option value="United Arab Erimates">United Arab Emirates</option>
								<option value="United Kingdom">United Kingdom</option>
								<option value="United States of America">United States of America</option>
								<option value="Uraguay">Uruguay</option>
								<option value="Uzbekistan">Uzbekistan</option>
								<option value="Vanuatu">Vanuatu</option>
								<option value="Vatican City State">Vatican City State</option>
								<option value="Venezuela">Venezuela</option>
								<option value="Vietnam">Vietnam</option>
								<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
								<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
								<option value="Wake Island">Wake Island</option>
								<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
								<option value="Yemen">Yemen</option>
								<option value="Zaire">Zaire</option>
								<option value="Zambia">Zambia</option>
								<option value="Zimbabwe">Zimbabwe</option>
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