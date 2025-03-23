  <?php
	include "CONNECTION.php";
	$user_id = $_SESSION["student"];
	$Result = 0;

	$paper_id = $_POST["paper_id"];
	$qus_id = $_POST["qus_id"];

	$i = 0;
	foreach ($qus_id as $k => $v) {
		$index = "ans".$v;
		$ans = $_POST[$index];
		if ($ans[0] == $_POST["answer"][$i]) {
			$Result++;
		}
		$i++;
	}
	
	$sql = "INSERT INTO `test_ans`(`user_id`, `paper_id`, `result`) VALUES ('$user_id','$paper_id','$Result')";
	mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student Result</title>
	<style>
		body {
			font-family: 'Arial', sans-serif;
			background-color: skyblue;
			margin: 0;
			padding: 0;
			text-align: center;
			background-image: url(); /* Replace 'path/to/your/image.jpg' with the actual path to your image file */
            background-size: cover; /* Ensures the image covers the entire background */
            background-repeat: no-repeat; /* Prevents the background image from repeating */
            background-attachment: fixed; /* Fixes the background image so it doesn't scroll with the page */
            font-family: Arial, sans-serif;
            margin: 0; 
		}

		h2, h3 {
			color: #333;
		}

		table {
			width: 80%;
			margin: 20px auto;
			border-collapse: collapse;
			background-color:azure;
		}

		table, th, td {
			border: 3px solid black;
		}
		th{
			background-color: #4285f4;
		}

		th, td {
			padding: 10px;
			text-align: left;
		}

		a {
			color: #4285f4;
			text-decoration: none;
			margin: 10px;
		}

		a:hover {
			text-decoration: underline;
		}
	</style>
</head>

<body>
	<?php 
		$sql1 = "SELECT * FROM `mcq_paper` WHERE `id`='$paper_id'";
		$result_1 = mysqli_query($connection, $sql1);
		$name = mysqli_fetch_array($result_1);
	?>

	<center>
		<div>
			<h2><b>Paper Name: <?php echo $name['paper_name'];?></b></h2><br>
			<h3><b>Your Score is: </b><i><?php echo $Result;?></i></h3>
		</div>
	</center>

	<table>
		<tr>
			<th>Question Number</th>
			<th>Correct Answer</th>
			<th>Your Answer</th>
		</tr>
		<?php
			$sql2 = "SELECT * FROM `mcq_question` WHERE `paper_id`='$paper_id'";
			$result2 = mysqli_query($connection, $sql2);
			$questionNumber = 1;

			while ($qus = mysqli_fetch_array($result2)) {
				$qus_id = $qus['qus_id'];
				$correctAnswer = $qus['ans'];
				$selectedAnswer = $_POST["ans" . $qus_id];
		?>
				<tr>
					<td><?php echo $questionNumber; ?></td>
					<td><?php echo $correctAnswer; ?></td>
					<td style="color: <?php echo ($correctAnswer == $selectedAnswer) ; ?>;">
						<?php 
						    // Check if $selectedAnswer is an array and convert it to a string
						    if (is_array($selectedAnswer)) {
						        echo implode(', ', $selectedAnswer);
						    } else {
						        echo $selectedAnswer;
						    }
						?>
					</td>
				</tr>
		<?php
				$questionNumber++;
			}
		?>
	</table>

	<hr/>
	<br>
	<a href="s_dashboard.php">Go To Your Dashboard</a>
	<br>
	<a href="logout.php">Logout</a>
</body>

</html>
