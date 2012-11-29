<?php
	require 'CloudFront.php';

	// your AWS/CloudFront keys go here
	$keyId          = "AKIAJKO3YXXGVMT3CJ3Q"; 
	$secretKey      = "x82hrOyU1dazFW9VbhOWkfu236mApd3njYSW1lSO";
	$distributionId = "E2WA4OO1HAQ3PV";

	$key = "/free-lottery/euro.php"; // String representing the existing CloudFront object to invalidate

	$cf  = new CloudFront($keyId, $secretKey, $distributionId);
?>
<html>
<head>
<style> textarea {width:100%; height:600px; font:12px/16px consolas;} </style>
</head>
<body>
	Key: <?PHP print $key; ?><br/>
	<hr/>
	CF call:<br/>
	<?/* 
	 	Passing "true" to enable debugging for the purpose of this example. 
		This will render the XML response.
	*/?>
	<textarea><?php $cf->invalidate($key, true); ?></textarea>
</body>
</html>
