<?php
header("Access-Control-Allow-Origin: *");
include('server_data2.php');


if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;

    exit;
}

if (!$link->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $link->error);
    exit();
}

if (isset($_GET)) {
   
    $promoname = $_GET['campaignname'];
    $promodetail = $_GET['campaigndetail'];
    $promoimg = $_GET['campaignimg'];
    $promourl = $_GET['campaignurl'];
    $promostart = $_GET['campaignstartdate'];
    $promoend = $_GET['campaignenddate'];
    echo 'Promotionname =' . $promoname;
    echo 'Promotiondetail =' . $promodetail;
    echo 'Promotionurl =' . $promourl;
    echo 'Promotionstart =' . $promostart;
    echo 'Promotionend =' . $promoend;
    echo 'PromotionPicture ='.$promoimg;
    date_default_timezone_set("Asia/Bangkok");
    $datenow = date("d/m/Y H:i:s");





    $sql = "INSERT INTO marketing_historial (promo_name,promo_detial,picture,url,stdate,enddate,present_datecampaign)
            VALUES ('$promoname','$promodetail','$promoimg','$promourl','$promostart','$promoend','$datenow')";
    $result = mysqli_query($link, $sql);
    if ($result) {
        echo "successfully";
    } else {
        echo "Have_error";
    }
}
mysqli_close($link);
