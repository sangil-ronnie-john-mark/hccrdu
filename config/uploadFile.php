<?php
SESSION_START();
require_once 'dbcon.php';

$title = ucfirst(strtolower($_POST['title']));
$year = addslashes($_POST['year']);
$author = addslashes($_POST['author']); 
$category = addslashes($_POST['category']);
$abstract = addslashes($_POST['abstract']);
$ocrPdf = addslashes($_POST['ocrPdf']);

$targetDir = "../assets/upload/pdf/";
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileName = basename($_FILES["fileToUpload"]["name"]);

$fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
$allowedTypes = ['pdf'];

if (!in_array($fileType, $allowedTypes)) {
    echo "Only PDF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {

    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO research (title, year, authors, program, abstract, filename, ocrPdf) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssss", $title, $year, $author, $category, $abstract, $fileName, $ocrPdf);

    if ($stmt->execute()) {
        $_SESSION['success'] = "The file " . htmlspecialchars($fileName) . " has been uploaded successfully.";
		Header('Location: ../admin/submissions.php');
    } else {
        echo "Failed to insert data into database.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Sorry, your file was not uploaded.";
}
?>
