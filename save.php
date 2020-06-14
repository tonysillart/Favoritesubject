<?php
require 'connection.php';

$title = mysqli_real_escape_string($mysqli, $_REQUEST['title']);
$description = mysqli_real_escape_string($mysqli, $_REQUEST['description']);
$topic1 = mysqli_real_escape_string($mysqli, $_REQUEST['Max_speed']);
$topic2 = mysqli_real_escape_string($mysqli, $_REQUEST['Accelerate']);

$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageURL = 'https://favoritesubject.tak17sillart.itmajakas.ee/upload/' . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST['submit']) && isset($_FILES['image'])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    $sql = "INSERT INTO BMW(title, description, image, Max_speed, Accelerate) VALUES ('$title', '$description', '$imageURL', '$topic1', '$topic2')";
}

if (file_exists($target_file)) {
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    $uploadOk = 0;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    $uploadOk = 0;
}

if ($uploadOk == 0) {
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
    } else {
        echo "There was an error uploading your file.";
    }
}

if (mysqli_query($mysqli, $sql)) {
    $referer = $_SERVER['HTTP_REFERER'];
    header("Location: $referer");
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
}

// Close connection
mysqli_close($mysqli);