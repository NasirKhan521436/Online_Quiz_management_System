
<?php
include "CONNECTION.PHP";

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

$sql1 = "INSERT INTO `users`(`user_id`, `pass`, `role`, `active`) VALUES (?, ?, ?, ?)";

$stmt1 = mysqli_prepare($connection, $sql1);
mysqli_stmt_bind_param($stmt1, 'ssss', $uid, $password, $role, $active);

if (!mysqli_stmt_execute($stmt1)) {
    echo "Error in users: " . $sql1 . "<br>" . mysqli_error($connection);
}
echo "user data inserted";

$sql2 = "INSERT INTO `user_info`(`user_id`, `full_name`, `email`, `edu`, `dob`, `gender`, `phone`, `address`, `active`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt2 = mysqli_prepare($connection, $sql2);
mysqli_stmt_bind_param($stmt2, 'sssssssss', $uid, $fname, $email, $edu, $dob, $gender, $phone, $address, $active);

if (!mysqli_stmt_execute($stmt2)) {
    echo "Error in user_info: " . $sql2 . "<br>" . mysqli_error($connection);
} else {
    $msg = 'User Successfully Inserted';
}

mysqli_stmt_close($stmt1);
mysqli_stmt_close($stmt2);

$alertMessage = " data entered sucessfully";

echo '<script type="text/javascript">alert("' . $alertMessage . '");</script>';

$err = "";

    $sql = "SELECT * FROM users WHERE user_id = ? AND pass = ?";
    
    // Using prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "is", $uid, $password);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Error: " . mysqli_error($connection));
    }

    if ($row = mysqli_fetch_array($result)) {
        $acctype = $row['role'];

        switch ($acctype) {
            case "admin":
                $_SESSION["admin"] = $uid;
                header('Location: admin.php');
                exit;
                break;

            case "teacher":
                $_SESSION["teacher"] = $uid;
                header('Location: t_dashboard.php');
                exit;
                break;

            case "student":
                $_SESSION["student"] = $uid;
                header('Location: s_dashboard.php');
                exit;
                break;

            default:
                $err = 'Invalid account type';
        }
    } else {
        $err = 'Invalid ID or Password';
    }

    mysqli_stmt_close($stmt);

    $alertMessage = " data entered sucessfully";

echo '<script type="text/javascript">alert("' . $alertMessage . '");</script>';


?>

        <?php
// Your PHP code here
echo '<a href="index.php">Go to index page</a>';
// More PHP code if needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <SCRIPT>alert("registration Sucessfully done");</SCRIPT>
</body>
</html>
