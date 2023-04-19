<?php
header("Access-Control-Allow-Origin: *");
include('server_data2.php');
error_reporting(E_ERROR | E_PARSE);

$response = new stdClass;
$response->status = null;
$response->message = null;


$destination_dir = "campaign_img/";
$base_filename = basename($_FILES["file"]["name"]);
$target_file = $destination_dir . $base_filename;

if (!$_FILES["file"]["error"]) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $response->status = true;
        $response->message = "File uploaded successfully";
    } else {

        $response->status = false;
        $response->message = "File uploading failed";
    }
} else {
    $response->status = false;
    $response->message = "File uploading failed";
}
// header('Content-Type: application/json');
// echo json_encode($response);

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
    $path = $_GET['path'];


    $sql_select = "SELECT picture
                FROM marketing_historial
                WHERE promo_name = '$promoname'
                ";

    $result = mysqli_query($link, $sql_select);
    $oldfilename = '';

    while ($row = mysqli_fetch_assoc($result)) {
        $oldfilename = $row['picture'];
    }
    $oldfilename .=  $path . ',';

    $sql_update = " UPDATE marketing_historial 
    SET picture='$oldfilename'
    WHERE promo_name = '$promoname'
";


    $result = mysqli_query($link, $sql_update);

    if ($result) {
        echo 'successfully';
    } else {
        echo 'error';
    }
}
mysqli_close($link);
