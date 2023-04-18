<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: image/jpeg');
$imgurl = $_GET['url'];
// header('location: requestPicture/request3293675_1662428595426040_1.jpg');
readfile($imgurl);