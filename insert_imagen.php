<?php
echo "fileimage";
header("Access-Control-Allow-Origin: *"); // เป็นการขอ Connect ต่าง Host กัน (การใส่ * คือการขอได้นอกจาก domain)
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


// Response object structure
$response = new stdClass;
$response->status = null;
$response->message = null;

$destination_dir = "campaign_img/";
$base_filename = basename($_FILES["file"]["name"]);
$target_file =$destination_dir. $base_filename;
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



