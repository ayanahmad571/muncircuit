<?php


$data = file_get_contents('b4.txt');







$data = str_replace('data:image/png;base64,', '', $data);

$data = str_replace(' ', '+', $data);

$data = base64_decode($data);

$file = 'images/'.rand() . '.png';

$success = file_put_contents($file, $data);

$data = base64_decode($data); 

$source_img = imagecreatefromstring($data);

$rotated_img = imagerotate($source_img, 90, 0); 

$file = 'images/'. rand(). '.png';

$imageSave = imagejpeg($rotated_img, $file, 10);

imagedestroy($source_img);


?>