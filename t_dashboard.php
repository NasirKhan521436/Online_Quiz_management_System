<?php
include "CONNECTION.PHP";
if (!isset($_SESSION["teacher"])) {
    header('Location: index.php');
    exit;
}

$sql1 = "SELECT * FROM user_info";
$result1 = mysqli_query($connection, $sql1);  // Change here, use mysqli_query()

while ($row = mysqli_fetch_array($result1)) {
    $user_id = $row['user_id'];
    if ($_SESSION["teacher"] == $user_id) {
        $getUid = $row['user_id'];
        $getName = $row['full_name'];
        $getEmail = $row['email'];
        $getEdu = $row['edu'];
        $getDOB = $row['dob'];
        $getGen = $row['gender'];
        $getPhn = $row['phone'];
        $getAdrs = $row['address'];
    }
}
?>

<html>
<head>
    <title>Teacher Dashboard || Online Quiz Test</title>
   <!-- <link rel="stylesheet" href="STYLE/t_dashboard.css">-->
      <link rel="stylesheet" href="STYLE/tt.css">
</head>
<body>
<center>
    <h1>Teacher Dashboard</h1>
    <hr>
    <img src="https://icon-library.com/images/teacher-icon-png/teacher-icon-png-16.jpg" height="180px" width="180px">
    <h3> Welcome <i><?php echo $getName;?></i></h3>
    <button onclick="window.location.href='update_tinfo.php'">Update Profile</button>
    <button onclick="window.location.href='fetch.php'">Search Student Result</button>

    <button onclick="window.location.href='my_question.php'">MY created papers</button>

    <button onclick="window.location.href='paper_name.php'">Submit New Paper</button>
    <button onclick="window.location.href='Sresult_list.php'">Test Result List</button>
    <!--<button onclick="window.location.href='triger.php'">trigger</button>-->

   <!-- <button onclick="window.location.href='logout.php'">Logout</button>-->
    
    <hr>
    <table border="1">
        <tr>
            <th>Your ID: </th>
            <td>
                <?php
                echo $getUid;
                ?>
            </td>
        </tr>
        <tr>
            <th>Your Name: </th>
            <td>
                <?php
                echo $getName;
                ?>
            </td>
        </tr>
        <tr>
            <th>Email: </th>
            <td>
                <?php
                echo $getEmail;
                ?>
            </td>
        </tr>
        <tr>
            <th>Education(Level): </th>
            <td>
                <?php
                echo $getEdu;
                ?>
            </td>
        </tr>
        <tr>
            <th>Date-Of-Birth: </th>
            <td>
                <?php
                echo $getDOB;
                ?>
            </td>
        </tr>
        <tr>
            <th>Gender: </th>
            <td>
                <?php
                echo $getGen;
                ?>
            </td>
        </tr>
        <tr>
            <th>Phone: </th>
            <td>
                <?php
                echo $getPhn;
                ?>
            </td>
        </tr>
        <tr>
            <th>Address: </th>
            <td>
                <?php
                echo $getAdrs;
                ?>
            </td>
        </tr>
    </table>
    <hr>
    <button onclick="window.location.href='logout.php'">Logout</button>
</center>
</body>
</html>
