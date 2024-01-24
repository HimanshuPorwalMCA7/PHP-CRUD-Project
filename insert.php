<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];

    $image = $_FILES["image"]["tmp_name"];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $fileType = finfo_file($finfo, $image);

    if (!in_array($fileType, $allowedTypes)) {
        die("Invalid file type. Please upload a valid image(png,jpg,gif).");
    }

    finfo_close($finfo);
    $stmt = $conn->prepare("INSERT INTO users (name, email, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $imgContent);

    $imgContent = file_get_contents($image);
    $stmt->send_long_data(2, $imgContent);

    if ($stmt->execute()) {
        echo "Data stored successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
