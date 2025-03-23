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

<html>
<head>
	<title>Student Dashboard || Online Quiz Test</title>
	<link rel="stylesheet" href="STYLE/s_dashboard.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style type="text/css">
    
        h1 {
           color:black;
           text-decoration:underline;
            }
      a:link {
        text-decoration: none;
      }

      .order-card {
        color: rgb(255, 255, 255);
      }

      .bg-c-blue {
        background: #04868f;
      }

      .bg-c-green {
        background:#4C51BF;
      }

      .bg-c-yellow {
        background: #F56565;
      }

      .bg-c-pink {
        background: #663a30;
      }


      .card {

        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        border: 1px solid black;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
      }

      .card .card-block {
        padding: 25px;
      }

      .order-card i {
        font-size: 26px;
      }

      .f-left {
        float: left;
      }

      .f-right {
        float: right;
      }
      header {
      left: 0px;
      right: 0px;
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
    text-emphasis-color:red;

}

.menu-item {
    color: rgb(189, 20, 20);
    text-decoration: none;
    padding: 10px;
    cursor: pointer;
    color:yellowgreen;
}

.menu-item:hover {
    background-color: #555;
}
    </style>
</head>
<body>
<center>
<h1>Student Dashboard
</h1>
  <img src="https://tse3.mm.bing.net/th?id=OIP.KNA4ZicFzwIIewr2_oJ-QwHaHa&pid=Api&P=0&h=180">
<h3> welcome <i><?php echo $getName;?></i></h3>
<hr>
<button onclick="window.location.href='fetch.php'">Check Result</button>
<button onclick="window.location.href='update_sinfo.php'">Update Profile</button>
<button onclick ="window.location.href='show_question.php'">Show Paper</button>
<button ONCLICK ="window.location.href='logout.php'">Logout</button>
<hr>
<div>   
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
</div>
<hr>
</center>
<div class="menu">
        <a href="#" class="menu-item" onclick="goToPage('home')">Home</a>
        <a href="#" class="menu-item" onclick="goToPage('about')">About</a>
        <a href="#" class="menu-item" onclick="goToPage('contact')">Contact</a>
    </div>
    <div id="content">
        <h2><!-- Content will be dynamically loaded here based on menu clicks --></h2>
    </div>

    <script>
        function goToPage(page) {
            var contentDiv = document.getElementById('content');

            if (page === 'home') {
                contentDiv.innerHTML = 'Welcome to our Online Quiz Management System! Explore and take exciting quizzes.';
            } else if (page === 'about') {
                contentDiv.innerHTML = 'About Us: We are committed to providing an engaging platform for creating, managing, and taking online quizzes. Our system is designed to simplify the quiz management process for educators and organizations.';
            } else if (page === 'contact') {
                contentDiv.innerHTML = 'Contact Us: Have questions or feedback? Reach out to us at tmir6104@gmail.com.';
            }
        }
    </script>
</body>
</html>