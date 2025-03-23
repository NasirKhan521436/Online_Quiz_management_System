<?php
require_once('CONNECTION.php');

if (isset($_POST['uid'])) {
    $uid = $_POST['uid'];

    // Perform proper SQL injection prevention using prepared statements
    $sql = "SELECT * FROM users WHERE user_id = ?";
    
    // Prepare the SQL statement
    $stmt = mysqli_prepare($connection, $sql);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $uid);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if (empty($uid)) {
        echo '<strong style="color: red">' . $uid . '</strong>' . '<strong style="color:red"> is taken or null</strong><br><input type="hidden" id="check_uid" name="check_uid" value=""/>';
    } elseif (mysqli_fetch_array($result) > 0) {
        echo '<strong style="color: red">' . $uid . '</strong>' . '<strong style="color:red"> is taken</strong><br><input type="hidden" id="check_uid" name="check_uid" value=""/>';
    } else {
        echo '<strong style="color: green">' . $uid . '</strong>' . '<strong style="color:green"> is OK</strong><br><input type="hidden" id="check_uid" name="check_uid" value="ok" required/>';
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>
