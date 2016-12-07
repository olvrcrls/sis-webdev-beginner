<?php
  session_start();
  header('Content-Type: image/jpeg');

  $fontSize = 30;
  $imageWidth = 100;
  $imageHeight = 40;

  $image = imagecreate($imageWidth, $imageHeight);
  imagecolorallocate($image, 255, 255, 255);

  $fontColor = imagecolorallocate($image, 0, 0, 0);

  for($x = 1; $x <= 20; $x++){
    $x1 = rand(1,100);
    $y1 = rand(1,50);
    $x2 = rand(1,100);
    $y2 = rand(1,50);
    $value = rand(1000,9999);
    imageline($image, $x1, $y1, $x2, $y2, $fontColor);
  }//for
  $_SESSION['text'] = $value;
  imagettftext($image, $fontSize, 18, 25, 40, $fontColor,'fontStyles.ttf', $value);
  imagejpeg($image);

?>
