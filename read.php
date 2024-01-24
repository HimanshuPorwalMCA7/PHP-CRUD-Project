<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, email, image FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .user-info {
            margin-bottom: 20px;
        }

        .user-info img {
            max-width: 100px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .user-details {
            display: inline-block;
        }

        .user-details h2 {
            margin: 0;
            color: #333;
        }

        .user-details p {
            margin: 0;
            color: #666;
        }

        hr {
            border: 0;
            height: 1px;
            background: #ddd;
            margin: 20px 0;
        }
    </style>';

    while ($row = $result->fetch_assoc()) {
        echo '<div class="user-info">';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="User Image" />';
        echo '<div class="user-details">';
        echo '<h2>' . $row["name"] . '</h2>';
        echo '<p>Email: ' . $row["email"] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<hr>';
    }
} else {
    echo "No records found";
}

$conn->close();
?>
