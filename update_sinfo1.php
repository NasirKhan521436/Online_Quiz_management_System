<?php
include "CONNECTION.php";
    if (!isset($_SESSION["student"])) {
        header('Location: index.php');
        exit;
    } 

    $sql = "SELECT * FROM user_info";
    $result = mysqli_query($connection,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $user_id= $row['user_id'];
        if($_SESSION["student"] == $user_id)
        {
        $msg="";
        $name = $_REQUEST['fname'];
        $email = $_REQUEST['email'];
        $dob = $_REQUEST['dob'];
        $edu = $_REQUEST['edu'];
        $phone = $_REQUEST['phone'];
        $address = $_REQUEST['address'];        
        $password = $_REQUEST['pass'];

        $sql1 = "UPDATE `user_info` SET `full_name`='$name',`email`='$email',`edu`='$edu',`dob`='$dob',`phone`='$phone',`address`='$address' WHERE user_id='$user_id'";
                if(!mysqli_query($connection,$sql1))
                    {
                        echo "Error in user_info: " . $sql. "<br>" . mysqli_error($connection);
                    }


        $sql2 ="UPDATE `users` SET `pass`='$password' WHERE user_id='$user_id'";
                if(!mysqli_query($connection,$sql2))
                    {
                        echo "Error in users: " . $sql1 . "<br>" . mysqli_error($connection);
                    }
                else
                {
                    $msg= 'Your Profile is  Successfully Updated';
                }
        }
        
    }
            
?>
<html>
<head><title>Student Dashboard || Online Quiz Test</title></head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        center {
            margin-top: 50px;
        }

        h1 {
            color: #333;
        }

        h2 {
            color: #555;
        }

        hr {
            border: 1px solid #ccc;
        }

        p {
            color: green;
        }

        a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
            margin-right: 20px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
<body>
    <script>
        alert("Updation Sucessfully Done ");
    </script>
<center>
<h1>Student Dashboard</h1>
<hr>
<h2>Updation !!!</h2>
<hr>
    <p style="color:green"><?php echo $msg; ?></p>
<br>
<a href="s_dashboard.php">Go To Your Dashboard</a>
<br>
<a href="logout.php">Logout</a>
</center>
</body>
</html>