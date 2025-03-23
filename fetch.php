<?php
include "connection.php";

// Check if the search parameters are set
if (isset($_GET['userId']) && isset($_GET['paperId'])) {
    // Get values from the request
    $userId = $_GET['userId'];
    $paperId = $_GET['paperId'];

    // SQL query to fetch results based on user_id and paper_id
    $sql = "SELECT `id`, `user_id`, `paper_id`, `result`, `created_at` FROM `test_ans` WHERE `user_id` = '$userId' AND `paper_id` = '$paperId'";
    $result = $connection->query($sql);

    // Check if results were found
    if ($result->num_rows > 0) {
        // Fetch the results into an associative array
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        // Return results as JSON
        header('Content-Type: application/json');
        echo json_encode($rows);
        exit; // Terminate script after sending JSON response
    } else {
        // No results found
        echo json_encode([]);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style src="STYLE\fetch.css"></STYLE>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
           BACKGROUND-IMAGE:URL(https://tse3.mm.bing.net/th?id=OIP.BbkXmMlhWIZfx9-Zo9hNngHaDs&pid=Api&P=0&h=180);
            background-size: cover; /* Ensures the image covers the entire background */
            background-repeat: no-repeat; /* Prevents the background image from repeating */
            background-attachment: fixed; /* Fixes the background image so it doesn't scroll with the page */
           
        }
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 20px;
}

h1 {
    color: #333;
    text-align: center;
    text-decoration: underline;
}

#search-form {
    margin-bottom: 20px;
    text-align: center;
}

label {
    margin-right: 10px;
}

input {
    padding: 8px;
    margin-right: 10px;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

table {
    width: 80%;
    border-collapse: collapse;
    margin-top: 20px;
    BACKGROUND-COLOR:white;

}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #4CAF50;
    color: white;
}

#result-body tr:nth-child(even) {
    background-color: #f9f9f9;
}

#result-body tr:hover {
    background-color: #ddd;
}

#result-body td {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

        /* Add your CSS styles here */
    </style>
</head>
<body>

    <h1>Search Results</h1>

    <form id="search-form">
        <label for="userId">Student_ID:</label>
        <input type="text" id="userId" name="userId" required>

        <label for="paperId">Paper_ID:</label>
        <input type="text" id="paperId" name="paperId" required>

        <button type="button" onclick="searchResult()">Search</button>
    </form>
    <center>

    <table id="result-table">
        <thead>
            <tr>
                <th>Result_ID</th>
                <th>Student_ID</th>
                <th>Paper_ID</th>
                <th>Result</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody id="result-body">
            <!-- Results will be displayed here -->
        </tbody>
    </table>
</center>

    <script>
        function searchResult() {
            var userId = document.getElementById('userId').value;
            var paperId = document.getElementById('paperId').value;

            var apiUrl = '?userId=' + userId + '&paperId=' + paperId;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => displayResults(data))
                .catch(error => console.error('Error:', error));
        }

        function displayResults(results) {
            var resultBody = document.getElementById('result-body');
            resultBody.innerHTML = '';

            if (results.length === 0) {
                alert('No results found.');
                return;
            }

            results.forEach(result => {
                var row = document.createElement('tr');
                row.innerHTML = `
                    <td>${result.id}</td>
                    <td>${result.user_id}</td>
                    <td>${result.paper_id}</td>
                    <td>${result.result}</td>
                    <td>${result.created_at}</td>
                `;
                resultBody.appendChild(row);
            });
        }
    </script>

</body>
</html>
