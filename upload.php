<?php
$roles = [
    'admin' => ['create', 'edit', 'delete'],
    'editor' => ['create', 'edit'],
    'viewer' => ['view'],
];
$user = [
    'name' => 'William',
    'role' => 'admin',
];
function hasPermission($userRole, $requiredPermission, $roles) {
    if (isset($roles[$userRole]) && in_array($requiredPermission, $roles[$userRole])) {
        return true;
    }
    return false;
} if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email tidak valid!";
        exit;
    } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
        echo "Hanya gambar JPEG dan PNG yang diizinkan!";
        exit;
    }

    $recaptchaSecret = "";
    $response = $_POST['g-recaptcha-response'];
    $remoteIp = $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => $recaptchaSecret,
        'response' => $response,
        'remoteip' => $remoteIp
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $resultData = json_decode($result);

    if ($resultData->success && hasPermission($user['role'], 'create', $roles)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
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
    } else {
        echo "Permission denied or reCAPTCHA verification failed.";
    }
}
?>
