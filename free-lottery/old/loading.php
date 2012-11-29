<?php


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="css/reset1.css"/>
<link rel="stylesheet" type="text/css" href="css/style1.css"/>
<script language="javascript">
setTimeout("window.location.href ='<?php print $_REQUEST['lotterymaster_dest']?>'",5000);
</script>
<title>Lottery</title>
</head>
<body>
<div class="container">
	<div class="wrapcontent">
		<h1>Lottery Master</h1>
		<p>Get ready to play  at Lotterymaster</p>
		<span>And get 2$ for FREE</span>
	<div class="bullets">	
		<div id="block_1" class="barlittle"></div>
		<div id="block_2" class="barlittle"></div>
		<div id="block_3" class="barlittle"></div>
		<div id="block_4" class="barlittle"></div>
		<div id="block_5" class="barlittle"></div>
	</div>
		<a href="<?php print $_REQUEST['lotterymaster_dest']?>">if you are not redirect in 5 seconds please click here</a>
	</div>
</div>
</body>
</html>