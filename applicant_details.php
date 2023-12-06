<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "brta";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $applicant_id = $_GET['id'];
    $sql = "SELECT * FROM license_applications WHERE id = $applicant_id";
    $result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="#"><img src="images/logo.png" class="logo" Salt=""></a>
        <nav>
            <ul id="navbar">
                <li><a class="active" href="#"><?php echo $_SESSION['username']; ?></a></li>
                <li><div id=""><a href="dashboard.php">Back</a></div></li>
            </ul> 
        </nav>
    </header>
    <section class="detailes">
    <h1>Detailes of Applicants</h1>
    <table>
        <tbody id="view">
            <?php
            if ($result->num_rows == 1) {
                $applicant = $result->fetch_assoc();

                echo '<tr>';
                echo "<p>Name: " . $applicant['name'] . "</p>";
                echo '</tr>';
                echo '<tr>';
                echo "<p>Email: " . $applicant['email'] . "</p>";
                echo '</tr>';
                echo '<tr>';
                echo "<p>NID: " . $applicant['nid'] . "</p>";
                echo '</tr>';
                echo '<tr>';
                echo "<p>Vehicle No: " . $applicant['vehicle_no'] . "</p>";
                echo '</tr>';
                echo '<tr>';
                echo '<tr>';
                echo '<tr>';
                echo "<p>NID<a href='" . $applicant['nid_copy_path'] . "'>View NID Copy</a></p>";
                echo '</tr>';
    
            }
            else {
                echo "Invalid request";
            }
    
            $conn->close();
        }
            ?>
            
        </tbody>
    </table>
    </section>
</body>
</html>