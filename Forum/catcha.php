<?php
session_start();

// Créer une chaîne de caractères aléatoire pour le captcha
$captcha = substr(md5(uniqid(rand(), true)), 0, 6);
$_SESSION['captcha'] = $captcha;

// Créer une image du captcha
$image = imagecreate(120, 40);
$background_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 5, 25, 10, $captcha, $text_color);
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>