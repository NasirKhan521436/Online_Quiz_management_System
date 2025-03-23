<?php
	include "CONNECTION.php";
	$sub = $_POST['subject'];
	
	$sql = "SELECT * FROM `mcq_paper` WHERE `subject`='$sub'";
	$result = mysqlI_query($connection,$sql);

	while ($ques = mysqlI_fetch_array($result)) {
		echo "<tr>".
		"<td>".$ques['subject']."</td>".
		"<td><a href='question_paper.php?paper_id=".$ques['id']."'>".$ques['paper_name']."</a></td>".
		"<td>".$ques['paper_time']."</td>".
		"</tr>";
	}
?>