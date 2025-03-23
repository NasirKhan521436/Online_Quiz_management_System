<?php
	
	include "CONNECTION.php";
	$userid = $_SESSION["student"];

	$sql = "SELECT * FROM `user_info` WHERE `user_id`='$userid'";
	$result = mysqli_query($connection,$sql);
	$data = mysqlI_fetch_array($result);
	$user_name = $data["full_name"];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Dashboard || Show Question Paper</title>
	<style>
		table {
		    border-collapse: collapse;
		    border: 1px solid #000;
		    text-align: left;
		}
		th, td {
		    padding: 10px;
		}
		body {
			font-family: 'Arial', sans-serif;
			background-color: white;
			margin: 0;
			padding: 0;
			text-align: center;
		}

		h3 {
			color: black;
		}

		hr {
			margin: 20px 0;
			border: none;
			border-top: 2px solid #ddd;
		}

		center {
			margin-top: 20px;
		}

		select {
			padding: 8px;
			margin: 10px;
			font-size: 16px;
		}

		table {
			border-collapse: collapse;
			width: 80%;
			margin: 20px auto;
		}
		thead{
			background-color:greenyellow;
			text-decoration:underline;
		}
		tbody{
			background-color:#ddd;
		}

		th, td {
			padding: 10px;
			border: 4px solid BLACK;
		}

		a {
			color: black;
			text-decoration: bold;
			margin: 10px;
		}

		a:hover {
			text-decoration: underline;
		}
		body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.menu {
    background-color: #333;
    display: flex;
    justify-content: space-around;
    align-items: center;
    height: 50px;
}

.menu-item {
    color: rgb(189, 20, 20);
    text-decoration: none;
    padding: 10px;
    cursor: pointer;
}

.menu-item:hover {
    background-color: #333;
}
	</style>
	<script src="jquery-1.12.3.min.js"></script>
</head>
<body>
<div class="menu">
        <a href="s_dashboard.php" class="menu-item" onclick="goToPage('home')">Home</a>
        <a href="#" class="menu-item" onclick="goToPage('about')">About</a>
        <a href="#" class="menu-item" onclick="goToPage('contact')">Contact</a>
    </div>
	<script>
        function goToPage(page) {
            var contentDiv = document.getElementById('content');

         if (page === 'about') {
                contentDiv.innerHTML = 'About Us: We are committed to providing an engaging platform for creating, managing, and taking online quizzes. Our system is designed to simplify the quiz management process for educators and organizations.';
            } else if (page === 'contact'){
                contentDiv.innerHTML = 'Contact Us: Have questions or feedback? Reach out to us at tmir6104@gmail.com.';
            }
        }
    </script>
<h3><b>Student Name: </b><i><?php echo $user_name; ?></i></h3>
<hr/>
<center>
	Select Subject:
	<select onchange="load_subject();" id="subject" name ="subject">
		<option value="all">All Subject</option>
        <option value="MATH">English</option>
        <option value="CODING">CODING</option>
        <option value="Math">Math</option>
        <option value="Physics">Physics</option>
        <option value="Chemistry">Chemistry</option>
    </select> 
    <br>
    <?php 
    	$sql = "SELECT * FROM `mcq_paper` ORDER BY `subject` ASC";
    	$result = mysqlI_query($connection,$sql);
    ?>
    <table>
    	<thead>
    		<tr>
	    		<td><b>Subject</b></td>
	    		<td><b>Question Paper Name</b></td>
	    		<td><b>Test Time</b></td>
    		</tr>
    	</thead>
    	<tbody id='list'>
    	<?php 
	    	while ($ques = mysqlI_fetch_array($result)) {
	    		echo "<tr>".
	    		"<td>".$ques['subject']."</td>".
	    		"<td><a href='question_paper.php?paper_id=".$ques['id']."'>".$ques['paper_name']."</a></td>".
	    		"<td>".$ques['paper_time']."</td>".
	    		"</tr>";
		 	}
    	?>
    	</tbody>
    	<tbody id="list_1">
    	</tbody>
    	
    </table>
</center>
<hr/>
<br>
<a href="s_dashboard.php">Go To Your Dashboard</a>
<br>
<a href="logout.php">Logout</a>
</body>
<script type="text/javascript">

	$(document).ready(function(){
		$("#list_1").hide();
	});

	function load_subject() {
		$("#list").hide();
		var subject = $('#subject').val();
		if (subject === "all") {
			$("#list").show();
		}
		else{
			//alert("selected Subject: "+subject);
			$("#list_1").show();
			
			$.ajax({
				type: "POST",
				url: "ajax_loaded_table.php",
				data: { subject : subject },
				dataType: "html",
				success: function (data) {
					//alert(data);
					//$("#list").hide();
					$("#list_1").html(data);
				}
			});

		}
		//alert("selected Subject: "+subject);

	}

</script>
</html>