<?php
require_once 'config.php';

$SIZE = 3;
$WIDTH = 130;
$HEIGHT = 30;

$im = imagecreatetruecolor($WIDTH, $HEIGHT);
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);

imagefilledrectangle($im, 0, 0, $WIDTH, $HEIGHT, $white);

// Captcha
$text = bin2hex(random_bytes($SIZE));
$_SESSION['captcha'] = $text;

imagepolygon($im, [
	0,0 ,
	($WIDTH/2),($HEIGHT-1) ,
	($WIDTH-1),($HEIGHT/2) ,
	0,($HEIGHT/2)
	], 4, $black);

$t = random_int(1, $SIZE*2);
$fsize = 20;

for($i=0;$i<$SIZE*2;$i++) {
	if($i%$t == 0)
		imagecharup($im, 3, $i*$fsize+10, ($HEIGHT/2), $text[$i], $black);
	else
		imagechar($im, 3, $i*$fsize+10, 10, $text[$i], $black);
}
header('Content-Type: image/jpeg');
imagejpeg($im);
imagedestroy($im);
