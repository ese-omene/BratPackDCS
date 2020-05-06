<?php

// Get variable values in $_FILES array:
var_dump($_FILES);

// Path of the file in temp directory:
$file_temp = $_FILES['staff__photo']['tmp_name'];
// Original path and file name of the uploaded file:
$file_name = $_FILES['staff__photo']['name'];
// Size of the uploaded file in bytes:
$file_size = $_FILES['staff__photo']['size'];
print_r($file_size);
// Type of the file (if browser provides):
$file_type = $_FILES['staff__photo']['type'];
// Error number
$file_error = $_FILES['staff__photo']['error'];

echo $file_temp . "<br />";
echo $file_name . "<br />";
echo $file_size . "<br />";
echo $file_type . "<br />";
echo $file_error . "<br />";
if ($file_error > 0) {
    echo "Problem uploading file.";
    switch ($file_error) {
        case 1:
            echo "File exceeded upload_max_filesize.";
            break;
        case 2:
            echo "File exceeded max_file_size.";
            break;
        case 3:
            echo "File only partially uploaded.";
            break;
        case 4:
            echo "No file uploaded.";
            break;
    }
    exit;
}

$max_file_size = 20000000;
if ($file_size > $max_file_size) {
    echo "File size too big.";
}

// Folder to move the uploaded file
$target_path = "images/staffdirectory/"; // Create folder
$target_path = $target_path . $_FILES['staff__photo']['name'];

//// Move the uploaded file from temp path to target path:
/// On a mac, or map you'll need to give recursive right permissions
if (move_uploaded_file($_FILES['staff__photo']['tmp_name'], $target_path)) {
    echo "The file " . $_FILES['staff__photo']['name'] . " has been uploaded. ";
} else {
    echo "There was an error uploading the file, please try again.";
}






