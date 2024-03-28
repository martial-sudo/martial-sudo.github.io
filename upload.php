<?php

// GitHub repository information
$repositoryOwner = "martial-sudo";
$repositoryName = "martial-sudo.github.io";
$branchName = "uploads"; // or any other branch

// File upload handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $file = $_FILES["fileToUpload"];

    // Check if file was uploaded without errors
    if ($file["error"] == UPLOAD_ERR_OK) {
        // Temporary file path
        $filePath = $file["tmp_name"];

        // Destination file path in the repository
        $destinationPath = "uploads/" . $file["name"];

        // Git commands to add and commit the file
        $gitCommands = [
            "git add " . $destinationPath,
            "git commit -m 'Uploaded " . $file["name"] . "'",
            "git push origin " . $branchName
        ];

        // Execute Git commands
        foreach ($gitCommands as $command) {
            exec($command);
        }

        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file.";
    }
}
?>