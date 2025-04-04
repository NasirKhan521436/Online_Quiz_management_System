<?php
  include "CONNECTION.php";
    if (!isset($_SESSION["student"])) {
        header('Location: index.php');
        exit;
    } 

    $sql = "SELECT * FROM users";
    $result = mysqli_query($connection,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $user_id= $row['user_id'];
        if($_SESSION["student"] == $user_id)
        {
            $getUid = $row['user_id'];
            $getPass = $row['pass'];
            $getRole = $row['role'];
        }
        
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
<head><title>Student Dashboard || Online Quiz Test</title></head>
<link rel="stylesheet" href="STYLE/signup.css">
<style>
    body{
    background-image:url(https://png.pngtree.com/thumb_back/fh260/background/20210205/pngtree-flat-business-login-box-login-page-image_544861.jpg);
    background-repeat: no-repeat;
    background-size: cover; /* Ensures the image covers the entire background */
     /* Prevents the background image from repeating */
            background-attachment: fixed; /* Fixes the background image so it doesn't scroll with the page */
            font-family: Arial, sans-serif;
            margin: 0; 
    }
    
</style>
<body>
<center>
<h1>Student Dashboard</h1>
<hr>
<form action="update_sinfo1.php" method="POST">
<h2>Update Your Profile </h2>
<table>
    <tr>
        <th>Full Name: </th>
        <td><input type="text" id="fname" name="fname" value="<?php echo $getName ?>"></td>
        <td><label id="fname"></label></td>
    </tr>
    <tr>
        <th>User ID: </th>
        <td><input type="text" id="uid" name="uid" value="<?php echo $getUid ?>" disabled></td>
        <td><label id="uid"></label></td>
    </tr> 
    
    <tr>
        <th>Email: </th>
        <td><input type="text" id="email" name="email" value="<?php echo $getEmail ?>"></td>
        <td><label id="email"></label></td>
    </tr> 
     <tr>
        <th>Gender: </th>
         <td><input type="text" id="gender" name="gender" value="<?php echo $getGen ?>" disabled></td>
    </tr>
    <tr>
        <th>DOB: </th>
        <td><input type="date" id="dob" name="dob" value="<?php echo $getDOB ?>"></td>
        <td><label id="dob"></label></td>
    </tr> 

    <tr>
        <th>You Role As: </th>
        <td><input type="text" id="role" name="role" value="<?php echo $getRole ?>" disabled></td>
    </tr>
    <tr>
            <th>Current Education Level: </th>
            <td><input type="text" name="cedu" value="<?php echo $getEdu ?>" disabled>
            </td>
        </tr>
    <tr>
        <th>Change Education Level: </th>
        <td><select id="edu" name="edu">
            <option>Phd</option>
            <option>Master's</option>
            <option>Graduate</option>
            <option>Under Graduate</option>
            <option>College</option>
            <option>School</option>
            </select>
        </td>
    </tr>
    <tr>
        <th>Phone: </th> 
        <td><input type="text" id="phone" name="phone" value="<?php echo $getPhn ?>"></td>
        <td><label id="phone"></label></td>
    </tr>
    <tr>
        <th>Address: </th> 
        <td><textarea id="address" name="address" cols="22" rows="4"><?php echo $getAdrs ?></textarea></td>
        <td><label id="address"></label></td>
    </tr>
    <tr>
        <th>Password: </th> 
        <td><input type="text" id="pass" name="pass" value="<?php echo $getPass ?>"></td>
        <td><label id="pass"></label></td>
    </tr>
    
    <tr>
        <th> </th>
        <td><input type="submit" name="submit" value="Update"></td>
    </tr>
</table>
</form>
<br>
<a href="s_dashboard.php">Go To Your Dashboard</a>
<br>
<a href="logout.php">Logout</a>
</center>
</body>
</html>