<?php
include "CONNECTION.php";
    if (!isset($_SESSION["teacher"])) {
        header('Location: index.php');
        exit;
    }

    $sql = "SELECT * FROM user_info";
    $result = mysqli_query($connection,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $user_id= $row['user_id'];
        if($_SESSION["teacher"] == $user_id)
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
                if(!mysqli_query($connection,$sql))
                    {
                        echo "Error in user_info: " . $sql. "<br>" . mysqli_error($cnooection,$sql);
                    }


        $sql2 ="UPDATE `users` SET `pass`='$password' WHERE user_id='$user_id'";
                if(!mysqli_query($connection,$sql2))
                    {
                        echo "Error in users: " . $sql1 . "<br>" . mysqli_error($cnooection,$sql2);
                    }
                else
                {
                    $msg= 'THANK YOU FOR UPDATING YOUR PROFILE';
                }
        }
        
    }
            
?>
<html>
<head><title>Teacher Dashboard || Online Quiz Test</title></head>
<body>
<DIV>
<center>
<h1>Teacher Dashboard</h1>
    <p style="color:green "><?php echo $msg; ?></p>
<br>
<a href="t_dashboard.php">Go To Your Dashboard</a>
<br>
<a href="logout.php">Logout</a>
</center>
</DIV>
<script>
    alert("Your Details are Sucessfully updated !!");
</script>
</body>
</html>