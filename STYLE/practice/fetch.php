<?php
include "C:\wamp64\www\MYQUIZ SYSTEM\connection.php";

// Check if the search parameters are set
if (isset($_GET['user_id']) && isset($_GET['paper_id'])) {
    // Get values from the request
    $userId = $_GET['user_id'];
    $paperId = $_GET['paper_id'];

    // SQL query to fetch results based on user_id and paper_id
    $sql = "SELECT `id`, `user_id`, `paper_id`, `result`, `created_at` FROM `test_ans` WHERE `user_id` = '$userId' AND `paper_id` = '$paperId'";
    $result = $connection->query($sql, $connection);

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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }
        /* Add your CSS styles here */
    </style>
</head>
<body>

    <h1>Search Results</h1>

    <form id="search-form">
        <label for="userId">User ID:</label>
        <input type="text" id="userId" name="userId" required>

        <label for="paperId">Paper ID:</label>
        <input type="text" id="paperId" name="paperId" required>

        <button type="button" onclick="searchResult()">Search</button>
    </form>

    <table id="result-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Paper ID</th>
                <th>Result</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody id="result-body">
            <!-- Results will be displayed here -->
        </tbody>
    </table>

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
