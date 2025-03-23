<?php
include "CONNECTION.PHP";
	if (!isset($_SESSION["student"])) {
		header('Location: index.php');
		exit;
	} 

	$sql1 = "SELECT * FROM user_info";
	$result1 = mysqli_query($connection,$sql1);
	while($row = mysqli_fetch_array($result1))
	{
		$user_id= $row['user_id'];
		if($_SESSION["student"] == $user_id)
		{
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