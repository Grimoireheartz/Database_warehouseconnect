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
    $path = $_GET['filename'];


    unlink(substr($path, 1, strlen($path)));
    $path = $path . ',';

    $sql_select = "SELECT picture
    FROM marketing_historial
    WHERE promo_name = '$promoname'
    ";


    $result = mysqli_query($link, $sql_select);
    $oldfilename = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $oldfilename = $row['picture'];
    }
    $oldfilename = str_replace($path, "", $oldfilename);

    $sql_update = " UPDATE marketing_historial 
    SET picture='$oldfilename'
    WHERE promo_name = '$promoname'
    ";

    $result = mysqli_query($link, $sql_update);

    } else {
    echo 'error';
    }   

mysqli_close($link);
