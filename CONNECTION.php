
<?php

session_start();
$servername = "localhost";
$username = "Your_username";
$password = "your_db_password";
$dbname = "online_quiz";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
// Close connection
echo "";

?>