<?php
// upload.php

// Start the session (if not already started)
include 'CONNECTION.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the user is logged in
    if (isset($_SESSION["uid"])) {
        // Check if the file was uploaded without errors
        if (isset($_FILES["profileImage"]) && $_FILES["profileImage"]["error"] == 0) {
            $targetDir = "uploads/"; // Change this to the desired directory
            $targetFile = $targetDir . basename($_FILES["profileImage"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if the file is an actual image
            $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if the file already exists
            if (file_exists($targetFile)) {
                echo "Sorry, the file already exists.";
                $uploadOk = 0;
            }

            // Check the file size (you can adjust the limit)
            if ($_FILES["profileImage"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            $allowedFormats = ["jpg", "jpeg", "png", "gif"];
            if (!in_array($imageFileType, $allowedFormats)) {
                echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                // If everything is OK, try to upload the file
                if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["profileImage"]["name"])) . " has been uploaded.";
                    // You can update the user's profile image in the database if needed
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            echo "No file uploaded or an error occurred.";
        }
    } else {
        echo "User not logged in.";
    }
} else {
    echo "Invalid request.";
}
?>
