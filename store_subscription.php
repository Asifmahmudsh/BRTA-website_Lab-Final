<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection credentials
    $servername = "localhost"; // Replace with your server name
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "brta"; // Replace with your database name

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "INSERT INTO subscriptions (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Subscription successful!";
        header("refresh:2; url=index.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>