<?php
class captcha
{

  var $UserString;
  var $font_path;

  function captcha()
  {
	  $this->font_path = SITE_FONT_PATH.'freesans.ttf';
  }

  function LoadPNG()
  { 
       $bgNUM = rand(1,2);
       $im = @imagecreatefrompng(SITE_FONT_PATH.'bg'.$bgNUM.'.png'); /* Attempt to open */
       if (!$im) { 
           $im  = imagecreatetruecolor(150, 30); /* Create a blank image */
           $bgc = imagecolorallocate($im, 255, 255, 255);
           $tc  = imagecolorallocate($im, 0, 0, 0);
           imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
           imagestring($im, 1, 5, 5, "Error loading $imgname", $tc);
       }
       return $im;
  }


  function task_string()
  {
         // create a image from png bank
        $image = $this->LoadPNG(); 
        $string_a = array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","R","S","T","U","V","W","X","Y","Z","2","3","4","5","6","7","8","9");
		$width=0;
        for($i=0;$i<5;$i++)
        {
            $colour     = imagecolorallocate($image, rand(0,155), rand(0,155), rand(0,155));
            $font		= $this->font_path;
            $angle      = rand(-15,15);

            // Add the text
            $width_pos  = rand(20,30);
            $width      = $width  + $width_pos;
            $height     = rand(35,75);
            $temp       = $string_a[rand(0,25)];
            $this->UserString .= $temp;
            imagettftext($image, 26, $angle, $width, $height, $colour, $font, $temp);
            $width    = $width + 3;
            $height   = $height + 3;
            imagettftext($image, 26, $angle, $width, $height, $colour, $font, $temp);
        }
        $_SESSION['captcha'] = $this->UserString;
        return $image;
  }


  function task_sum()
  {
         // create a image from png bank
          $image    = $this->LoadPNG(); 
          $colour = imagecolorallocate($image, rand(0,155), rand(0,155), rand(0,155));
          $font   = $this->font_path;
          $angle  = rand(-15,15);

          // Add the text
          $width = rand(20,30);
          $height = rand(35,75);

          $number1 = rand(1,99);
          $number2 = rand(1,9);

          imagettftext($image, 26, $angle, $width, $height, $colour, $font, $number1);

          $colour = imagecolorallocate($image, rand(0,155), rand(0,155), rand(0,155));
          $width  += 45; 
          imagettftext($image, 26, 0, $width, $height, $colour, $font, '+');

          $colour   = imagecolorallocate($image, rand(0,155), rand(0,155), rand(0,155));
          $width   += 25; 
          $angle    = rand(-15,15);
          imagettftext($image, 26, $angle, $width, $height, $colour, $font, $number2.'=?');

          $this->UserString = $number1+$number2;  
          $_SESSION['captcha'] = $this->UserString;
          return $image;         
  }

  function task_deduction()
  {

         // create a image from png bank
          $image    = $this->LoadPNG(); 

          $colour = imagecolorallocate($image, rand(0,155), rand(0,155), rand(0,155));
          $font   = $this->font_path;
          $angle  = rand(-15,15);

          // Add the text
          $width = rand(20,30);
          $height = rand(35,75);

          $number1 = rand(1,99);
          $number2 = rand(1,9);

          imagettftext($image, 26, $angle, $width, $height, $colour, $font, $number1);

          $colour = imagecolorallocate($image, rand(0,155), rand(0,155), rand(0,155));
          $width  += 45; 
          imagettftext($image, 26, 0, $width, $height, $colour, $font, '-');

          $colour   = imagecolorallocate($image, rand(0,155), rand(0,155), rand(0,155));
          $width   += 25; 
          $angle    = rand(-15,15);
          imagettftext($image, 26, $angle, $width, $height, $colour, $font, $number2.'=?');

          $this->UserString = $number1-$number2;  
          
          $_SESSION['captcha'] = $this->UserString;

          return $image;         
  } 

  function display(){
 	  
        switch(1)
        {
          case 1  : $image  = $this->task_string();     break;
          case 2  : $image  = $this->task_sum();        break;
          case 3  : $image  = $this->task_deduction();  break;
          default : $image  = $this->task_string();     break;      
        }
        // output the picture
        header("Content-type: image/png");
        imagepng($image);  
  } 

  function check_result(){
	if($_SESSION['captcha']!=$_REQUEST['capt'] || $_SESSION['captcha']=='BADCODE')
	{ 	
		$_SESSION['captcha']='BADCODE';
		return false;
	} 
	else 
	{
	  	return true;
	}
  } 
}
?>