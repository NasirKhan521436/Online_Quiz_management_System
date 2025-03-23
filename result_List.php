<?php
// Database connection
include "CONNECTION.php";

// Fetching results from test_ans table
$query = "SELECT `user_id`, `paper_id`, `result`, `created_at` FROM `test_ans` WHERE 1";
$result = mysqli_query($connection, $query);

// HTML starts here
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Students' Test Results</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
         background-image: url(https://img.freepik.com/free-photo/abstract-design-background-smooth-flowing-lines_1048-14640.jpg);
        background-size: cover; /* Ensures the image covers the entire background */
            background-repeat: no-repeat; /* Prevents the background image from repeating */
            background-attachment: fixed; /* Fixes the background image so it doesn't scroll with the page */
            font-family: Arial, sans-serif;
            margin: 0; 
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
        text-decoration: underline;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }
    th {
        background-color: green;
    }
    .button{
        color:black;
        padding:20px;
        height:50px;
        background-color: greenyellow;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Students' Test Results</h1>
    <table>
        <thead>
            <tr>
                <th>Student_ID</th>
                <th>Paper_ID</th>
                <th>Result</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through results and display in table rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['paper_id'] . "</td>";
                echo "<td>" . $row['result'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <button onclick="window.location.href='admin.php'">Go to your dashboard</button>
    
</div>
</body>
</html>
