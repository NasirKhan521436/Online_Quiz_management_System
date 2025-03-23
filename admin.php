<?php
	session_start();
	if (!isset($_SESSION["admin"])) {
		header('Location: index.php');
		exit;
	} 
  
?>


<html>
<head>
<title>WELCOME TO ADMIN DASHBOARD  ||   Online Quiz Test</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style type="text/css">
        body {
    background-color: #268ea8; /* Set your desired background color */
    font-family: Arial, sans-serif;
     background-image: url(data:image/jpeg;base64,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); /* Replace 'path/to/your/image.jpg' with the actual path to your image file */
            background-size: cover; /* Ensures the image covers the entire background */
            background-repeat: no-repeat; /* Prevents the background image from repeating */
            background-attachment: fixed; /* Fixes the background image so it doesn't scroll with the page */
            font-family: Arial, sans-serif;
            margin: 0; 
            height:500vh;
}
        h1 {
           color:darkgoldenrod;
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
    </style>
</head>                     
<body>
<center>
    <br>


<hr>
<h1>Welcome To Admin Dashboard || Online Quiz Management System </h1>
<br><br>
<!--<h3>Teacher</h3><br>
<div id="sidebar">
            <p id="sm">Search Menu</p>
            <div><img src="images/Screenshot 2024-02-06 203153.png" alt="">
                <p onclick="navigate(11)">CNR number</p>
            </div>
            <div><img src="images/Screenshot 2024-02-06 203134.png" alt="">
                <p onclick="navigate(12)">Case status</p>
            </div>
            <div><img src="images/Screenshot 2024-02-06 203056.png" alt="">
                <p onclick="navigate(9)">Court orders</p>
            </div>
            <div> <img src="images/OIP.jpg" alt="">
                <p onclick="navigate(15)">Location</p>
            </div>
    </div>
<button><a href="teacher_list.php">teacher list</a></button><BR>
<button><a href="teacher_approve.php">teacher approve</a></button><BR>
<button><a href="teacher_remove.php">DELETE TEACHER</a></button><BR>
</div>

<div>
<h3>Student</h3><br>
<button><a href="student_list.php">STUDENT list</a></button><BR>
<button><a href="student_remove.php">STUDENT DELETE</a></button><BR>

</div>-->

<div>

<!--<h3>Questions</h3><br>-->
<div class="container">
    <div class="row">
   <!-- <img src="https://d2434a0nr1d7t1.cloudfront.net/p/D430_35_425/D430_35_425_1200.jpg" height="150px" width="150px">


--> <div class="col-md-4 col-xl-6">
        <div class="card bg-c-pink order-card">
          <div class="card-block">
            <h3 class="m-b-20">Teacher list</h3>
           <h4 class="text-right"><span><button onclick="window.location.href='teacher_list.php'">click here </button><BR></span></h4>

          </div>
        </div>
      </div>
     
      <div class="col-md-4 col-xl-6">
        <div class="card bg-c-pink order-card">
          <div class="card-block">
            <h3 class="m-b-20">Remove Teacher</h3>
            <h4 class="text-right"><span><button onclick="window.location.href='teacher_remove.php'">click here</button><BR></span></h4>

          </div>
        </div>
      </div>
      
     <!-- <img src="https://www.usnews.com/cmsmedia/a1/7c/61548aea4db9ab9045673bb5187f/160919-studentscollege-stock.jpg "height= "150px" width="150px"/>
--> <div class="col-md-4 col-xl-6">
        <div class="card bg-c-pink order-card">
          <div class="card-block">
            <h3 class="m-b-20">Student list</h3>
            <h4 class="text-right"><span><button onclick="window.location.href='student_list.php'">click here</button><BR></span></h4>

          </div>
        </div>
      </div>

      <div class="col-md-4 col-xl-6">
        <div class="card bg-c-pink order-card">
          <div class="card-block">
            <h3 class="m-b-20"> Remove Student</h3>
            <h4 class="text-right"><span><button onclick="window.location.href='student_remove.php'">click here</button><BR></span></h4>

          </div>
        </div>
      </div>
      <br>

      <div class="col-md-4 col-xl-6">
        <div class="card bg-c-pink order-card">
          <div class="card-block">
            <h3 class="m-b-20">Question Papers</h3>
            <h4 class="text-right"><span><button onclick="window.location.href='question_list.php'">click here</button><BR></span></h4>

          </div>
        </div>
      </div>

      <div class="col-md-4 col-xl-6">
        <div class="card bg-c-pink order-card">
          <div class="card-block">
            <h3 class="m-b-20">Delete Paper</h3>
            <h4 class="text-right"><span><button onclick="window.location.href='question_remove.php'">click here</button><BR></span></h4>

          </div>
        </div>
      </div>


      <br>
      <div class="col-md-4 col-xl-6" >
        <div class="card bg-c-pink order-card">
          <div class="card-block">
            <h3 class="m-b-20">Approve Teacher</h3>
            <h4 class="text-right"><span><button onclick="window.location.href='teacher_approve.php'">click here</button><BR></span></h4>

          </div>
        </div>
      </div>

      <div class="col-md-4 col-xl-6">
        <div class="card bg-c-pink order-card">
          <div class="card-block">
            <h3 class="m-b-20"> Student Result List</h3>
           <h4 class="text-right"><span><button onclick="window.location.href='result_list.php'">click here</button><BR></span></h4>

          </div>
        </div>
      </div>

      <br>
      <div class="col-md-4 col-xl-6">
        <div class="card bg-c-pink order-card">
          <div class="card-block">
            <h3 class="m-b-20"> Search Student Result</h3>
           <h4 class="text-right"><span><button onclick="window.location.href='fetch.php'">click here</button><BR></span></h4>

          </div>
        </div>
      </div>

      <div class="col-md-4 col-xl-6">
        <div class="card bg-c-pink order-card">
          <div class="card-block">
            <h3 class="m-b-20">Logout</h3>
           <h4 class="text-right"><span><button onclick="window.location.href='logout.php'">click here</button><BR></span></h4>

          </div>
        </div>
      </div>


    </div>
  </div>

<!--<button><a href="question_list.php">paper and subject list</a></button><BR>
<button><a href="question_remove.php">remove  paper</a></button><BR>-->
</div>

<br>
</center>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</body>
</html>
