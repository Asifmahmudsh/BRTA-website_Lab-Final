<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $servername = "localhost"; 
    $username = "root"; 
    $password = "";
    $dbname = "brta"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
     }

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        }
    }

    
    header("Location: login.html?error=1");
    exit();
} else {
    
    header("Location: login.html");
    exit();
}
?>