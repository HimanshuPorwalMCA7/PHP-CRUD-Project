<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["id"];
    $newEmail = $_POST["email"];

    if ($_FILES['newImage']['size'] > 0) {
        $newImage = $_FILES['newImage']['tmp_name'];
        $newImgContent = addslashes(file_get_contents($newImage));

        $servername = "localhost";
        $username = "root";
        $password = '';
        $dbname = "test";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE users SET email = '$newEmail', image = '$newImgContent' WHERE id = $userId";

        if ($conn->query($sql) === TRUE) {
            echo "Information updated successfully";
        } else {
            echo "Error updating information: " . $conn->error;
        }

        $conn->close();
    } else {
        $servername = "localhost";
        $username = "root";
        $password = '';
        $dbname = "test";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE users SET email = '$newEmail' WHERE id = $userId";

        if ($conn->query($sql) === TRUE) {
            echo "Information updated successfully";
        } else {
            echo "Error updating information: " . $conn->error;
        }

        $conn->close();
    }
}
?>
