<?php
// session_start();
class gencaptcha
{
	var $string;
	
	function __construct()
	{ $string = ""; }
	
	function getcaptcha()
	{	
		$ln = 5;
		$possible = '23456789bcdfghjkmnpqrstvwxyz';
		$i = 0;
		while ($i < $ln) { 
			$string .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		
		$_SESSION['b2b_random_captcha'] = $string;
		$dir = SPATH_ROOT.'/fonts/';
		$width = '165';
		$height = '50';
		$image = imagecreatetruecolor($width, $height);
		// random number 1 or 2
		$num = rand(1,3);
		if($num == 1) {
			// $font = "Capture it 2.ttf"; // font style
			$font = "freesans.ttf";
		} else if($num == 2) {
			$font = "Molot.otf";// font style
		} else {
			$font = "Capture it 2.ttf";
		}
		// random number 1 or 2
		$num2 = rand(1,2);
		if($num2==1) {
			$color = imagecolorallocate($image, 113, 193, 217);// color
		} else {
			$color = imagecolorallocate($image, 163, 197, 82);// color
		}
		$white = imagecolorallocate($image, 255, 255, 255); // background color white
		imagefilledrectangle($image,0,0,399,99,$white);
		
		$noise_color = imagecolorallocate($image, 179, 197, 179);
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/2; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 0, 0, $noise_color);
		}
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		
		imagettftext ($image, 30, 0, 10, 40, $color, $dir.$font, $_SESSION['b2b_random_captcha']);
		header("Content-type: image/png");
		imagepng($image);
	}
	
	function chkcaptcha($string)
	{
		if(strtolower($string) == strtolower($_SESSION['b2b_random_captcha'])) {
			return true;
		}
		return false;
	}
	
}
?>