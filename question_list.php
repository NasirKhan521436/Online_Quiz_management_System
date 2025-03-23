<?php
INCLUDE "CONNECTION.PHP";
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
		body{
			background-image: url(https://getwallpapers.com/wallpaper/full/8/d/a/1295019-popular-best-nature-hd-wallpapers-1920x1080.jpg);
			background-size: cover; /* Ensures the image covers the entire background */
            background-repeat: no-repeat; /* Prevents the background image from repeating */
            background-attachment: fixed; /* Fixes the background image so it doesn't scroll with the page */
            font-family: Arial, sans-serif;
		}
		table {
    width: 80%;
    border-collapse: collapse;
    margin-top: 20px;
	background-color: #dee2e6;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

th {
    background-color: #007bff;
    color: white;
}

tr:hover {
    background-color: #e9ecef;
}

a {
    text-decoration: none;
    display: inline-block;
    padding: 10px 20px;
    margin: 10px;
    color: #fff;
    background-color: #dc3545;
    border-radius: 4px;
    transition: background-color 0.3s;
}

a:hover {
    background-color: #bd2130;
}
	</style>
</head>
<body>
<center>
	<h1>Question Papers Created</h1>
	<hr/>
	<table border='1'>
	<tr><th>Subject</th><th>Question Paper Name</th><th>Test Time</th></tr>	
		<?php

			$sql = "SELECT * FROM `mcq_paper`";
			$result = mysqlI_query($connection, $sql);
			if ($result) {
				while($row = mysqlI_fetch_assoc($result)) {
					echo "<tr> <td>". $row["subject"]."</td> <td>" . $row["paper_name"]. "</td> <td>" . $row["paper_time"]."</td> </tr>";
				}
			}else {
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
