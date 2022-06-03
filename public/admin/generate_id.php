<?php
 
// Get the incoming image data
$image = $_POST["image"];
$code = $_POST["code"];

// Remove image/jpeg from left side of image data
// and get the remaining part
$image = explode(";", $image)[1];
 
// Remove base64 from left side of image data
// and get the remaining part
$image = explode(",", $image)[1];
 
// Replace all spaces with plus sign (helpful for larger images)
$image = str_replace(" ", "+", $image);
 
// Convert back from base64
$image = base64_decode($image);
 
// Save the image as filename.jpeg

$filename = "../../app/src/id_dir/admin_id/QRID-". $code.".jpeg";

if(file_exists($filename)){
    echo "File already exist, click the download button to download the generated ID.";
}
if(!file_exists($filename)){
    file_put_contents($filename, $image);
    echo "ID created, please refresh the page then click the download button to download the generated ID.";
}
?>