<?php
include "CONNECTION.php";

if (!isset($_SESSION["admin"])) {
    header('Location: index.php');
    exit;
}
?>

<html>
<head>
    <title>Admin Panel || Online Quiz Test</title>
	<link rel="stylesheet" href="teacher_remove.css">
</head>
<body>
<center>
    <h1>Manage Teachers </h1>
    <hr/>
    <table border='1'>
        <?php
        $sql = "SELECT t2.* FROM `users` as t1 INNER JOIN `user_info` as t2 on t1.user_id = t2.user_id WHERE `role`= 'teacher'";
        $result = mysqli_query($connection, $sql);

        if ($result) {
            echo"<tr><th>Name</th> <th>education level </th> <th>email</th> <th>phone</th> <th>address</th><th>user_id</th> <th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $uid = $row["user_id"];
                echo "<tr> <td>" . $row["full_name"] . "</td> <td>" . $row["edu"] . "</td> <td>" . $row["email"] . "</td> <td>" . $row["phone"] . "</td> <td>" . $row["address"] . "</td> <td>" . $uid . 
                    "</td><td><a href='teacher_remove.php?user_id_de=" . $uid . "'>Remove</a></td>" .
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
if (isset($_GET["user_id_de"])) {
    $uid = $_GET["user_id_de"];
    $sql2 = "DELETE FROM `user_info` WHERE user_id='$uid'";
    if (!mysqli_query($connection, $sql2)) {
        echo "Error in user_info: " . $sql2 . "<br>" . mysqli_error($connection);
    }
    $sql3 = "DELETE FROM `users` WHERE user_id='$uid'";
    if (!mysqli_query($connection, $sql3)) {
        echo "Error in user_info: " . $sql3 . "<br>" . mysqli_error($connection);
    } else {
        echo $msg = 'Removed';
    }

    header("Location: teacher_remove.php");
}
?>
