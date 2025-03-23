<?php
include "CONNECTION.PHP";

##if (!isset($_SESSION["admin"])) {
  ## header('Location: index.php');
  ## exit;
##}

$fname = $_REQUEST['fname'] ?? '';
$email = $_REQUEST['email'] ?? '';
$dob = $_REQUEST['dob'] ?? '';
$gender = $_REQUEST['gender'] ?? '';
$role = $_REQUEST['role'] ?? '';
$active = $_REQUEST['active'] ?? '';
$edu = $_REQUEST['edu'] ?? '';
$phone = $_REQUEST['phone'] ?? '';
$address = $_REQUEST['address'] ?? '';
$password = $_REQUEST['pass'] ?? '';
$uid = $_REQUEST['uid'] ?? '';
$msg = "";

// Generate a unique user_id using uniqid
#$uid = uniqid();

$sql1 = "INSERT INTO `users`(`user_id`, `pass`, `role`, `active`) 
VALUES ('$uid', '$password', '$role', '$active')";

if (!mysqli_query($connection, $sql1)) {
    echo "Error in users: " . $sql1 . "<br>" . mysqli_error($connection);
}
echo "user data inserted";

$sql2= "INSERT INTO `user_info`(`user_id`, `full_name`, `email`, `edu`, `dob`, `gender`, `phone`, `address`, `active`)
VALUES ('$uid','$fname','$email','$edu','$dob','$gender','$phone','$address','$active')";

if (!mysqli_query($connection, $sql2)) {
    echo "Error in user_info: " . $sql2 . "<br>" . mysqli_error($connection);
} 
else {
    $msg = 'User Successfully Inserted';
}
?>
<html>

<head>
    <title>User Confirmation || Online Quiz Test</title>
</head>

<body>
    <center>
        <h1>User Confirmation || Online Quiz Test</h1>
        <hr>
        <p style="color:green"><?php echo $msg; ?></p>
       <!-- <a href="index.php">Go To Home Page</a>--->
    </center>
</body>

</html>
