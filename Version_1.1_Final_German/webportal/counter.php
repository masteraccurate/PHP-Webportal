<?php
  $bgcolor = array(0,0,0);  $fgcolor = array(255,255,255);  $borderlight = array(128,128,128);  $borderdark = array(80,80,80);  $counterwidth = 90;  $counterheight = 22;  $pad_left = 5;  $pad_top = 3;
  $filename = "./counter.txt";
  list($counter) = @file($filename);if (!isset($_COOKIE['besucher'])) {	setcookie ("besucher","1");
	$counter++;
	$fh = fopen($filename,"w");
	if ($fh) {		fwrite($fh,$counter);		fclose($fh);	}}
      $counter = str_pad($counter,9,"0",STR_PAD_LEFT);
  //echo "Sie sind der $counter. Besucher.";
  function color2pal(&$image,$rgb)   {    return imagecolorallocate($image,$rgb[0],$rgb[1],$rgb[2]);  }
  $im = imagecreate($counterwidth,$counterheight);  $idx_bgcolor = color2pal($im,$bgcolor);  $idx_fgcolor = color2pal($im,$fgcolor);  $idx_borderlight = color2pal($im,$borderlight);  $idx_borderdark = color2pal($im,$borderdark);     imagefilledrectangle($im,0,0,$counterwidth,$counterheight,$idx_bgcolor);  imageline($im,0,0,$counterwidth-1,0,$idx_borderdark);  imageline($im,0,$counterheight-1,$counterwidth-1,$counterheight-1,$idx_borderlight);  imageline($im,0,0,0,$counterheight-1,$idx_borderdark-1);  imageline($im,$counterwidth-1,0,$counterwidth-1,$counterheight-1,$idx_borderlight);  imagestring($im,5,$pad_left,$pad_top,$counter,$idx_fgcolor);    header("Content-type: image/png");  imagepng($im);     imagedestroy($im);   ?>