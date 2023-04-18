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

$sql = "SELECT promo_name,promo_detial,picture,url,stdate,enddate,present_datecampaign
                FROM marketing_historial ";

$result = mysqli_query($link, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
} else {
    echo 'error';
}

mysqli_close($link);
