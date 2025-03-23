<?php
include "CONNECTION.PHP";
$err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['uid'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE user_id = ? AND pass = ?";
    
    // Using prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "is", $username, $password);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Error: " . mysqli_error($connection));
    }

    if ($row = mysqli_fetch_array($result)) {
        $acctype = $row['role'];

        switch ($acctype) {
            case "admin":
                $_SESSION["admin"] = $username;
                header('Location: admin.php');
                exit;
                break;

            case "teacher":
                $_SESSION["teacher"] = $username;
                header('Location: t_dashboard.php');
                exit;
                break;

            case "student":
                $_SESSION["student"] = $username;
                header('Location: s_dashboard.php');
                exit;
                break;

            default:
                $err = 'Invalid account type';
        }
    } else {
        $err = 'Invalid ID or Password';
    }

    mysqli_stmt_close($stmt);
}
?>

<html>

<head>
    <title>Home Page || Online Quiz Test</title>
    <link rel="stylesheet" href="STYLE/index.css">
    <link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity=
"sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
        crossorigin="anonymous" />
</head>
<style>
    

        .menu {
            background-color: #333;
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 50px;
            width:165vh;
        }

        .menu-item {
            color: navy burlywood;
            text-decoration: none;
            padding: 10px;
            cursor: pointer;
        }

        .menu-item:hover {
            background-color: #555;
        }

        #content {
            padding: 20px;
            border: 0.5px solid blue;
            margin: 20px;
            background-color:transparent;
            color:greenyellow;
            box-shadow: 0 0 10PX rgb(0, 0, black);
            text-size-adjust: 5px;
        }
        h1{
            color:yellow;
            text-align:center;
        }
        h2{
            color:darkgoldenrod;
        }
        h4{
            color:white;
        }
        
</style>
<body>
<div class="menu">
      <h3>  <a href="#" class="menu-item" onclick="goToPage('home')">Home</a><h3>
       <h3> <a href="#" class="menu-item" onclick="goToPage('about')">About</a></h3>
       <h3> <a href="#" class="menu-item" onclick="goToPage('contact')">Contact</a><h3>
    </div>
    <div id="content">
        <!-- Content will be dynamically loaded here based on menu clicks -->
    </div>
<h2>
    <script>
        function goToPage(page) {
            var contentDiv = document.getElementById('content');

            if (page === 'home') {
                contentDiv.innerHTML = 'Welcome to our Online Quiz Management System! Explore and take exciting quizzes.';
            } else if (page === 'about') {
                contentDiv.innerHTML = 'About Us: We are committed to providing an engaging platform for creating, managing, and taking online quizzes. Our system is designed to simplify the quiz management process for educators and organizations.';
            } else if (page === 'contact') {
                contentDiv.innerHTML = 'Contact Us: Have questions or feedback? Reach out to us at tmir6104@gmail.com';
            }
        }
    </script>
    </h2>
<center>
    
    <hr>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <h2>Welcome To Online Quiz Management System</h2>
        <table>
        <h2>Login Page</h2>
            <tr>
                <th><h4>User ID:</h4> </th>
                <td><input type="text" id="uid" name="uid"></td>
            </tr>
            <tr>
               <th><h4>Password: </h4></th>
                <td><input type="password" id="pass" name="pass"></td>
            </tr>
            <tr>
                <th> </th>
                <td>
                    <p style="color:red"><?php echo $err; ?></p>
                    click here for signin <input type="submit" name="submit" value="Login">
                </td>
            </tr>
        </table>
    </form>  
</center>
<button class="signup-button" onclick="window.location.href='signup.php'">Sign Up</button>

</body>
</html>
