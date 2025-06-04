<?php
SESSION_START();
if ($_SESSION['login_status']) {
include '../css/plugins.php';
?>
<html lang="en" class="h-100">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>HCC Research Database System</title>
</head>
<body class="d-flex flex-column h-100">

<?php include 'css/navbar.php'?>



<main class="flex-grow-1 d-flex justify-content-center align-items-center">
  <div  class="text-center w-50">
    <h3>HOLY CROSS COLLEGE</h3>
    <h3>RESEARCH DATABASE SYSTEM</h3>
	
	<form action="search.php" method="GET">
		<div class="input-group mt-3">
		  <input type="text" name="search" class="form-control" placeholder="Search" required>
		  <button class="btn btn-primary" type="submit">
			<i class="bi bi-search"></i>
		  </button>
		</div>
	</form>
	
  </div>
</main>
<?php include '../css/footer.php'; ?>
</body>
<?php
} else {
	$_SESSION['error'] = "Invalid Token";
	Header('Location: ../');
}
?>