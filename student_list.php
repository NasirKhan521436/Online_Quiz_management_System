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
	<link rel="stylesheet" href="STYLE/teacher_list.css">
</head>
<body>
<center>
	<h1> STUDENT LIST </h1>
	<hr/>
	<table border='1'>
		<?php

			$sql = "SELECT t2.* FROM `users` as t1 INNER JOIN `user_info` as t2 on t1.user_id = t2.user_id WHERE `role`= 'student' ";
			$result = mysqli_query($connection,$sql);
			if ($result) {
				echo"<tr><th>Name</th> <th>email</th> <th>Number</th></tr>";
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr> <td>". $row["full_name"]."</td> <td>" . $row["email"]. "</td> <td>" . $row["phone"]."</td> </tr>";
				}
			}else {
				echo "Theacher not found..!!";
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
