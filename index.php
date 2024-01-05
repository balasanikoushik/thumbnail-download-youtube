<?php
require 'index.html';
if (isset($_POST['button'])) {
  $imgUrl = filter_var($_POST['imgurl'], FILTER_SANITIZE_URL);
  if (filter_var($imgUrl, FILTER_VALIDATE_URL) === false) {
    die('Not a valid URL');
  }
  $ch = curl_init($imgUrl);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $downloadImg = curl_exec($ch);
  if (curl_errno($ch)) {
    die('Error: ' . curl_error($ch));
  }
  $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
  curl_close($ch);
  header('Content-type: ' . $contentType);
  header('Content-Disposition: attachment;filename="thumbnail.jpg"');
  echo $downloadImg;
}
?>