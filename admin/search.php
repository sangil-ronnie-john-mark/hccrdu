<?php
SESSION_START();
if (!$_SESSION['login_status']) {
    $_SESSION['error'] = "Invalid Token";
    header('Location: ../loginPage.php');
    exit();
}

include '../config/dbcon.php'; // This must define $conn = new mysqli(...)

$search = trim($_GET['search'] ?? '');

if (!$search) {
    echo "No search query provided.";
    exit();
}

// Basic multi-column LIKE search
$query = "
    SELECT id, title, authors, year, abstract, filename, program, ocrPdf
    FROM research 
    WHERE 
        title LIKE ? OR 
        authors LIKE ? OR 
        abstract LIKE ? OR 
        program LIKE ? OR 
        year LIKE ? OR 
        ocrPdf LIKE ? 
    ORDER BY year DESC
";

$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$like = "%$search%";
$stmt->bind_param("ssssss", $like, $like, $like, $like, $like, $like);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results - HCC Research Database</title>
    <link rel="stylesheet" href="../css/plugins.php">
</head>
<body class="d-flex flex-column min-vh-100">
<?php include 'css/navbar.php'; ?>

<main class="container mt-5 mb-5 flex-grow-1">
    <h3>Search Results for: <em><?= htmlspecialchars($search) ?></em></h3>
    <hr>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="border rounded p-3 mb-4 shadow-sm">
                <h5 class="mb-1"><?= htmlspecialchars($row['title']) ?></h5>
                <small>
                    <strong>Authors:</strong> <?= htmlspecialchars($row['authors']) ?> |
                    <strong>Year:</strong> <?= htmlspecialchars($row['year']) ?> |
                    <strong>Program:</strong> <?= htmlspecialchars($row['program']) ?>
				
                </small>
                <p class="mt-2">
                    <?= nl2br(htmlspecialchars(substr($row['abstract'], 0, 300))) ?>...
                </p>
			<a href="../assets/upload/pdf/<?=$row['filename']?>" class="btn btn-outline-primary" target="_blank">
    View PDF
</a>

                <?php if (!empty($row['ocrPdf'])): ?>
                    
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No results found. Try another search term.</p>
    <?php endif; ?>
</main>

<?php include '../css/footer.php'; ?>
</body>
</html>
