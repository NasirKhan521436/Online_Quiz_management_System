<?php 

	include "CONNECTION.PHP";
	$userid = $_SESSION["teacher"];
	//echo $userid ;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Make Question Paper</title>
	<link rel="stylesheet" href="STYLE/MAKEQUESTION.css">
</head>
<body>
<h3><b>User Name: </b><i><?php echo $userid; ?></i></h3>
<center>
	<h1> Make Question Paper</h1>

<div>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		Subject Name: <select  id= "subject" name = "subject">
                        <option value="English">English</option>
                        <option value="Bangla">OS</option>
                        <option value="Math">Math</option>
                        <option value="Physics">Physics</option>
                        <option value="Chemistry">Chemistry</option>
                    </select>
                    <?php
                          /*  
                            $sql = "SELECT id FROM department";
                            $result = mysql_query($sql);

                            if ($result) {
                                while($row = mysql_fetch_assoc($result)) {
                                    echo "<option>".$row['id']."</option>";
                                }
                            }*/
                    	?>
                 </br>
		<!--<br>Paper Name: <textarea rows='1' cols='10' name="paper_name"></textarea><br>-->
                 Paper Name: <input type="text" name="paper_name" /><br>
		Paper Time: <input type="text" name="paper_time" /><br>
		<input type="submit" name="submit" value="SUBMIT/NEXT">
	</form>
 </div>
</center>
<hr/><br>
<a href="t_dashboard.php">Go To Your Dashboard</a>
<br>
<a href="logout.php">Logout</a>
<?php
if(isset($_POST['submit'])){
	$subject = $_POST["subject"];
	$paper_name = $_POST["paper_name"];
	$paper_time = $_POST["paper_time"];

	//echo $subject;
	//print_r($data);
	//die();

	$sql = "INSERT INTO `mcq_paper`(`user_id`, `subject`, `paper_name`, `paper_time`) VALUES ('$userid','$subject','$paper_name','$paper_time')";
	mysqli_query($connection, $sql);

	$sql = "SELECT * FROM `mcq_paper`where `user_id`='$userid' and `paper_name`='$paper_name'";

	$result = mysqli_query($connection, $sql);
	//echo $result;
	$data = mysqli_fetch_array($result);
	$paper_id = $data['id'];
	$_SESSION["paper_id"] = $paper_id;
	/*echo $asd;
	echo "<pre>";
	?id='.$mselcted_memberI
	print_r($data);
	echo "</pre>";*/
	header('Location: make_question.php');
}
?>
</body>
</html>