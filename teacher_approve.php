<?php
include "CONNECTION.PHP";

if (!isset($_SESSION["admin"])) {
    header('Location: index.php');
    exit;
}

?>

<html>
<head>
    <title>Admin Panel || Online Quiz Test</title>
	<link rel="stylesheet" href="teacher_approve.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #93a89e;
    margin: 0;
    padding: 0;
    background-image: url(https://getwallpapers.com/wallpaper/full/8/d/a/1295019-popular-best-nature-hd-wallpapers-1920x1080.jpg);
			background-size: cover; /* Ensures the image covers the entire background */
            background-repeat: no-repeat; /* Prevents the background image from repeating */
            background-attachment: fixed; /* Fixes the background image so it doesn't scroll with the page */
            font-family: Arial, sans-serif;

}

</style>
<body>
<center>
    <h1> Teacher Approve </h1>
    <hr/>
    <table border='1'>
        
        <?php
        $sql = "SELECT t2.* FROM `users` as t1 INNER JOIN `user_info` as t2 on t1.user_id = t2.user_id WHERE `role`= 'teacher'";
        $result = mysqli_query($connection, $sql);
        
        if ($result) {
            echo"<tr><th> Name</th> <th>education</th> <th>email</th> <th>PHONE</th> <th>ADDRESS</th> <th> USER_ID</th><th>Action</th></tr> ";
            while ($row = mysqli_fetch_assoc($result)) {
                $uid = $row["user_id"];
                echo "<tr> <td>" . $row["full_name"] . "</td> <td>" . $row["edu"] . "</td> <td>" . $row["email"] . "</td> <td>" . $row["phone"] . "</td> <td>" . $row["address"] . "</td> <td>" . $uid . "</td> <td>" .
                    "<a href='teacher_approve.php?user_id_ap=" . $uid . "'>Approve</a>" .
                    "</td><td><a href='teacher_approve.php?user_id_de=" . $uid . "'>Declined</a></td>" .
                    "</tr><br>";
            }
        } else {
            echo "Teacher not found..!!";
        }
        ?>
    </table>
</center>
<hr/><br>
<a href="admin.php">Go To Your Dashboard</a>
<br>
<a href="logout.php">Logout</a>
</body>
</html>

<?php
if (isset($_GET["user_id_ap"])) {
    $uid = $_GET["user_id_ap"];
    $sql1 = "UPDATE `user_info` SET `active`=1 WHERE user_id='$uid'";
    if (!mysqli_query($connection, $sql1)) {
        echo "Error in user_info: " . $sql1 . "<br>" . mysqli_error($connection);
    } else {
        echo $msg = 'Approved';
    }

    header("Location: teacher_approve.php");
} elseif (isset($_GET["user_id_de"])) {
    $uid = $_GET["user_id_de"];
    $sql2 = "DELETE FROM `user_info` WHERE user_id='$uid'";
    if (!mysqli_query($connection, $sql2)) {
        echo "Error in user_info: " . $sql2 . "<br>" . mysqli_error($connection);
    }
    $sql3 = "DELETE FROM `users` WHERE user_id='$uid'";
    if (!mysqli_query($connection, $sql3)) {
        echo "Error in user_info: " . $sql3 . "<br>" . mysqli_error($connection);
    } else {
        echo $msg = 'Declined';
    }

    header("Location: teacher_approve.php");
}
?>
