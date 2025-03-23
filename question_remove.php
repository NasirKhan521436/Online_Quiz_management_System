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
    <style>
        table {
            border-collapse: collapse;
            border: 1px solid #000;
            text-align: left;
        }
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
<center>
    <h1>Manage Question Papers </h1>
    <hr/>
    <table border='1'>
        <tr><th>Subject</th><th>Question Paper Name</th><th>Test Time</th><th>Action</th></tr>

        <?php
        $sql = "SELECT * FROM `mcq_paper`";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $uid = $row["id"];
                echo "<tr> <td>" . $row["subject"] . "</td> <td>" . $row["paper_name"] . "</td> <td>" . $row["paper_time"] . "</td>" .
                    "<td><a href='question_remove.php?user_id_de=" . $uid . "'>Remove</a></td>" .
                    "</tr><br>";
            }
        } else {
            echo "Question paper not found..!!";
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
    $sql5 = "SELECT * FROM `mcq_question` WHERE `paper_id`= '$uid'";
    $result = mysqli_query($connection, $sql5);

    while ($row = mysqli_fetch_assoc($result)) {
        $qus_id = $row['qus_id'];
        $sql2 = "DELETE FROM `mcq_option` WHERE `qus_id`= '$qus_id'";
        mysqli_query($connection, $sql2);
    }

    $sql3 = "DELETE FROM `mcq_question` WHERE `paper_id`= '$uid'";
    mysqli_query($connection, $sql3);

    $sql4 = "DELETE FROM `mcq_paper` WHERE `id`= '$uid'";
    if (!mysqli_query($connection, $sql4)) {
        echo "Error in deleting question paper: " . $sql4 . "<br>" . mysqli_error($connection);
    } else {
        echo $msg = 'Question paper removed successfully';
    }

    header("Location: question_remove.php");
}
?>
