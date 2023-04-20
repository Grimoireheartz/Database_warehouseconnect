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

    $promoname = $_GET['promoname'];
    $promodetail = $_GET['promadetail'];
    $promourl = $_GET['url'];
    $promostart = $_GET['startdate'];
    $promoend = $_GET['enddate'];
    $datenow = $_GET['presentdate'];

    $sql = "UPDATE marketing_historial 
            SET 
            -- promo_name = '$promoname'
            promo_detial='$promodetail',
            url='$promourl',
            stdate='$promostart',
            enddate='$promoend',
            present_datecampaign='$datenow'
            
            WHERE promo_name = '$promoname'
            ";
    $result = mysqli_query($link,$sql);
    if ($result) {
        echo "successfully";
    } else {
        echo "error";
    }

}
mysqli_close($link);

?>