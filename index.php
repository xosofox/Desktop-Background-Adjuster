<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Resiza</title>
</head>
<body>


<img src="src.jpg" width="100%">
<pre>

<?php

$src=imagecreatefromjpeg("src.jpg");
$src_w=imagesx($src);
$src_h=imagesy($src);
$src_ratio=$src_w/$src_h;

$out_w=1280+1920+1280;
$out_h=1200;

$out_w=$out_h*$src_ratio;

echo "$src_w  -> $out_w\n$src_h -> $out_h";


#copy resized to temp
$tmp=imagecreatetruecolor($out_w,$out_h);
imagecopyresampled($tmp,$src,0,0,0,0,$out_w,$out_h,$src_w,$src_h);

$out_w=1280+1920+1280;
$out_h=1200;

#copy only used part

$out=imagecreatetruecolor($out_w,$out_h);
imagecopy($out,$tmp,0,0,0,0,$out_w,$out_h);

#rearrange
#move middle+right to left, left to right

$tmp=imagecreatetruecolor(1280,1200);

#left to tmp
imagecopy($tmp,$out,0,0,0,0,1280,1200);

#middle+right to left

imagecopy($out,$out,0,0,1280,0,1920+1280,1200);

imagecopy($out,$tmp,1920+1280,0,0,0,1280,1200);


#move up

imagecopy($out,$out,1920,-45,1920,0,1280+1280,1200);

imagejpeg($out,"out.jpg");

?>

</pre>
<img src="out.jpg" width="100%">

</body>
</html>