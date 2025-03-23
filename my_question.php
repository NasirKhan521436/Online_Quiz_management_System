<?php

	include "CONNECTION.php";
	$userid = $_SESSION["teacher"];

?>
<!DOCTYPE html>
<html>
<head>
	<title>My Question</title>
	<!--<link rel="stylesheet" href="STYLE/QUESTION.css">-->
          <link rel="stylesheet" href="STYLE/QUESTION.css">
        
	<style>
             body{
             background-image: url(https://images.pexels.com/photos/3255761/pexels-photo-3255761.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1); /* Replace 'path/to/your/image.jpg' with the actual path to your image file */
            background-size: cover; /* Ensures the image covers the entire background */
            background-repeat: no-repeat; /* Prevents the background image from repeating */
            background-attachment: fixed; /* Fixes the background image so it doesn't scroll with the page */
            font-family: Arial, sans-serif;
            margin: 0; }
					</style>
</head>
<body>
<h3><b>User id: </b><i><?php echo $userid; ?></i></h3>
<center>
	<h1> My Question Papers </h1>
	<hr/>
	<table border='1'>
		<tr>
			<td>Subject</td>
			<td>Paper Name</td>
			<td>Paper Time</td>
		</tr>
		<?php

			$sql = "SELECT * FROM `mcq_paper` WHERE `user_id`='$userid'";
			$result = mysqlI_query($connection, $sql);
			if ($result) {
				while($row = mysqlI_fetch_assoc($result)) {
					echo "<tr> <td>". $row["subject"]."</td> <td>" . $row["paper_name"]. "</td> <td>" . $row["paper_time"]."</td> </tr>";
				}
			}else {
				echo "No paper was created..!!";
			}
		?>
	</table>
</center>
<hr/><br>
<a href="t_dashboard.php">Go To Your Dashboard</a>
<br>
<a href="logout.php">Logout</a>
</body>
</html>