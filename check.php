<?php
include "CONNECTION.php";
$err = "";

    $sql = "SELECT * FROM users WHERE user_id = ? AND pass = ?";
    
    // Using prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "is", $username, $password);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Error: " . mysqli_error($connection));
    }

    if ($row = mysqli_fetch_array($result)) {
        $acctype = $row['role'];

        switch ($acctype) {
            case "admin":
                $_SESSION["admin"] = $username;
                header('Location: admin.php');
                exit;
                break;

            case "teacher":
                $_SESSION["teacher"] = $username;
                header('Location: t_dashboard.php');
                exit;
                break;

            case "student":
                $_SESSION["student"] = $username;
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

?>