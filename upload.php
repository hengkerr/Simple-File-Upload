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
        $dbHost = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "fileupload";

        $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("INSERT INTO uploads (email, image_path) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $targetFile);

        if ($stmt->execute()) {
            echo "File berhasil diunggah.";
        } else {
            echo "Error storing data!";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Gagal Mengunggah File!";
    }
}
?>
