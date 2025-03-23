<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
</head>
<body>
    <h1>Quiz Result</h1>
    <form action="update_result.php" method="post">
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required><br><br>
        
        <label for="quiz_id">Quiz ID:</label>
        <input type="text" id="quiz_id" name="quiz_id" required><br><br>
        
        <label for="questions_attempted">Number of Questions Attempted:</label>
        <input type="number" id="questions_attempted" name="questions_attempted" required><br><br>
        
        <label for="score">Score:</label>
        <input type="number" id="score" name="score" required><br><br>
        
        <input type="submit" value="Update Result">
    </form>
</body>
</html>
<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_id = $_POST["student_id"];
    $quiz_id = $_POST["quiz_id"];
    $questions_attempted = $_POST["questions_attempted"];
    $score = $_POST["score"];

    // Database connection
    $servername = "localhost";
    $username = "";
    $password = "password";
    $dbname = "quiz_database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve previous result from the database
    $sql = "SELECT score FROM student_results WHERE student_id='$student_id' AND quiz_id='$quiz_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Update result if new score is greater than previous score
        $row = $result->fetch_assoc();
        $previous_score = $row["score"];
        if ($score > $previous_score) {
            $update_sql = "UPDATE student_results SET score='$score' WHERE student_id='$student_id' AND quiz_id='$quiz_id'";
            if ($conn->query($update_sql) === TRUE) {
                echo "Result updated successfully";
            } else {
                echo "Error updating result: " . $conn->error;
            }
        } else {
            echo "New score is not greater than previous score. Result not updated.";
        }
    } else {
        echo "Previous result not found for the student and quiz.";
    }

    // Close database connection
    $conn->close();
}
?>

