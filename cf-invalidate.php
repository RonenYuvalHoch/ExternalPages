<?php
/**
 * Super-simple AWS CloudFront Invalidation Script
 * 
 * Steps:
 * 1. Set your AWS access_key
 * 2. Set your AWS secret_key
 * 3. Set your CloudFront Distribution ID
 * 4. Define the batch of paths to invalidate
 * 5. Run it on the command-line with: php cf-invalidate.php
 * 
 * The author disclaims copyright to this source code.
 *
 * Details on what's happening here are in the CloudFront docs:
 * http://docs.amazonwebservices.com/AmazonCloudFront/latest/DeveloperGuide/Invalidation.html
 * 
 */
	$access_key          = "AKIAJKO3YXXGVMT3CJ3Q"; 
	$secret_key      = "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";
	$distribution = "E2WA4OO1HAQ3PV";
//$access_key = 'AWS_ACCESS_KEY';
//$secret_key = 'AWS_SECRET_KEY';
//$distribution = 'DISTRIBUTION_ID';
$epoch = date('U');

$xml = <<<EOD
<InvalidationBatch xmlns="http://cloudfront.amazonaws.com/doc/2012-07-01/">
    <Paths>
       <Quantity>18</Quantity>
       <Items>
           <Path>/free-lottery/euro.php</Path>
           <Path>/free-lottery/powerball.php</Path>
           <Path>/free-lottery/elgordo.php</Path>
           <Path>/free-lottery/euromillions.php</Path>
           <Path>/free-lottery/laprimi.php</Path>
           <Path>/free-lottery/megamillions.php</Path>
           <Path>/free-lottery/national.php</Path>
           <Path>/free-lottery/superlotto.php</Path>
           <Path>/free-lottery/ukeuromillions.php</Path>
           <Path>/buy-now/euro.php</Path>
           <Path>/buy-now/powerball.php</Path>
           <Path>/buy-now/elgordo.php</Path>
           <Path>/buy-now/euromillions.php</Path>
           <Path>/buy-now/laprimi.php</Path>
           <Path>/buy-now/megamillions.php</Path>
           <Path>/buy-now/national.php</Path>
           <Path>/buy-now/superlotto.php</Path>
           <Path>/buy-now/ukeuromillions.php</Path>
       </Items>
    </Paths>
    <CallerReference>{$distribution}{$epoch}</CallerReference>
</InvalidationBatch>
EOD;


/**
 * You probably don't need to change anything below here.
 */
$len = strlen($xml);
$date = gmdate('D, d M Y G:i:s T');
$sig = base64_encode(
    hash_hmac('sha1', $date, $secret_key, true)
);

$msg = "POST /2012-07-01/distribution/{$distribution}/invalidation HTTP/1.0\r\n";
$msg .= "Host: cloudfront.amazonaws.com\r\n";
$msg .= "Date: {$date}\r\n";
$msg .= "Content-Type: text/xml; charset=UTF-8\r\n";
$msg .= "Authorization: AWS {$access_key}:{$sig}\r\n";
$msg .= "Content-Length: {$len}\r\n\r\n";
$msg .= $xml;

$fp = fsockopen('ssl://cloudfront.amazonaws.com', 443, 
    $errno, $errstr, 30
);
if (!$fp) {
    die("Connection failed: {$errno} {$errstr}\n");
}
fwrite($fp, $msg);
$resp = '';
while(! feof($fp)) {
    $resp .= fgets($fp, 1024);
}
fclose($fp);
echo $resp;
