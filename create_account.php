<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["c-user"];
    $password = password_hash($_POST["c-password"], PASSWORD_DEFAULT); // Hashing the password

    // Check if username already exists
    $sql_check = "SELECT userid FROM users WHERE username = '$username'";
    $result_check = $conn->query($sql_check);

    if ($result_check === FALSE) {
        die("Error checking username: " . $conn->error);
    }

    if ($result_check->num_rows > 0) {
        echo "Username already exists";
    } else {
        // Insert new user
        $sql_insert = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "New account created successfully";
        } else {
            die("Error creating account: " . $conn->error);
        }
    }
    $conn->close();
}
?>
