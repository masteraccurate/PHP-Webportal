<?php
  $bgcolor = array(0,0,0);
  $filename = "./counter.txt";
  list($counter) = @file($filename);
	$counter++;
	$fh = fopen($filename,"w");
	if ($fh) {
    
  //echo "Sie sind der $counter. Besucher.";
  function color2pal(&$image,$rgb) 
  $im = imagecreate($counterwidth,$counterheight);