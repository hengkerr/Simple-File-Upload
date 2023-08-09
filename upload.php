<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email tidak valid!";
        exit;
    } if ($imageFileType !== "jpg" && $imageFileType !== "jpeg" && $imageFileType !== "png") {
        echo "Hanya gambar JPEG dan PNG!";
        exit;
    } if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file!";
    }
}
?>