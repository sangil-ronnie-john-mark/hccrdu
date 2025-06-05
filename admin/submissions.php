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
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">

<?php include 'css/navbar.php'?>

<main class="d-flex justify-content-center align-items-start mt-4 flex-grow-1">
  <div class="text-start w-75">
  
 <?php if (isset($_SESSION['error'])): ?>
    <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        setTimeout(() => {
            const alertElement = document.getElementById('error-alert');
            if (alertElement) {
                const alert = bootstrap.Alert.getOrCreateInstance(alertElement);
                alert.close();
            }
        }, 3000);
    </script>
<?php 
    unset($_SESSION['error']);
endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['success']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        setTimeout(() => {
            const alertElement = document.getElementById('success-alert');
            if (alertElement) {
                const alert = bootstrap.Alert.getOrCreateInstance(alertElement);
                alert.close();
            }
        }, 3000);
    </script>
<?php 
    unset($_SESSION['success']);
endif; ?>


 <div class="container mt-5">
  <div class="shadow p-5 mb-5 bg-white rounded border">
   <h3 class="mb-4">Submissions</h3>
    <form action="../config/uploadFile.php" method="POST" enctype="multipart/form-data">
      <!-- Title Input -->
 <div class="row mb-3">
  <!-- Title Input (longer) -->
  <div class="col-md-9">
    <label for="pdfTitle" class="form-label">Title</label>
    <input type="text" class="form-control" id="pdfTitle" name="title" placeholder="Enter title" required>
  </div>

  <!-- Year Input (shorter) -->
  <div class="col-md-3">
    <label for="yearInput" class="form-label">Year</label>
    <input type="number" class="form-control" id="yearInput" name="year" placeholder="Enter year" min="1900" max="2099" required>
  </div>
</div>


	<!-- Author Input -->
	<div class="mb-3">
	  <label for="authorInput" class="form-label">Author(s)</label>
	  <input type="text" class="form-control" id="authorInput" name="author" placeholder="Enter author(s)" required>
	  <div class="form-text">Separate multiple authors with commas.</div>
	</div>
      <!-- PDF File Upload -->
      <div class="mb-3">
        <label for="pdfFile" class="form-label">Upload PDF</label>
        <input class="form-control" type="file" id="pdfFile" name="fileToUpload" accept=".pdf" required>
      </div>

      <!-- Options Select (e.g., category) -->
  <div class="row mb-3">
  <div class="col-md-6">
    <label for="departmentSelect" class="form-label">Department</label>
    <select class="form-select" id="departmentSelect" name="department" required>
      <option selected disabled value="">Choose...</option>
      <option value="School of Computing, Information Technology and Engineering">School of Computing, Information Technology and Engineering</option>
      <option value="School of Business and Accountancy">School of Business and Accountancy</option>
      <option value="School of Arts, Sciences, and Education">School of Arts, Sciences, and Education</option>
      <option value="School of Tourism and Hospitality Management">School of Tourism and Hospitality Management</option>
      <option value="School of Criminal Justice">School of Criminal Justice</option>
    </select>
  </div>

  <div class="col-md-6">
    <label for="categorySelect" class="form-label">Program</label>
    <select class="form-select" id="categorySelect" name="category" required disabled>
      <option selected disabled value="">Choose...</option>
      
      <!-- School of Computing -->
      <option value="Bachelor of Science in Information Technology" data-dept="School of Computing, Information Technology and Engineering">Bachelor of Science in Information Technology</option>
      <option value="Bachelor of Science in Computer Engineering" data-dept="School of Computing, Information Technology and Engineering">Bachelor of Science in Computer Engineering</option>
      <option value="Bachelor of Science in Computer Science" data-dept="School of Computing, Information Technology and Engineering">Bachelor of Science in Computer Science</option>
      <option value="Bachelor of Science in Civil Engineering" data-dept="School of Computing, Information Technology and Engineering">Bachelor of Science in Civil Engineering</option>
      
      <!-- Business and Accountancy -->
      <option value="Bachelor of Science in Accounting Information System" data-dept="School of Business and Accountancy">Bachelor of Science in Accounting Information System</option>
      <option value="Bachelor of Science in Accountancy" data-dept="School of Business and Accountancy">Bachelor of Science in Accountancy</option>
      <option value="Bachelor of Science in Business Administration major in Financial Management" data-dept="School of Business and Accountancy">Bachelor of Science in Business Administration major in Financial Management</option>
      <option value="Bachelor of Science in Business Administration major in Marketing Management" data-dept="School of Business and Accountancy">Bachelor of Science in Business Administration major in Marketing Management</option>

      <!-- Arts, Sciences, and Education -->
      <option value="Bachelor of Elementary Education" data-dept="School of Arts, Sciences, and Education">Bachelor of Elementary Education</option>
      <option value="Bachelor of Science in Psychology" data-dept="School of Arts, Sciences, and Education">Bachelor of Science in Psychology</option>
      <option value="Bachelor of Science in Development Communication" data-dept="School of Arts, Sciences, and Education">Bachelor of Science in Development Communication</option>
      <option value="Bachelor of Secondary Education major in English" data-dept="School of Arts, Sciences, and Education">Bachelor of Secondary Education major in English</option>
      <option value="Bachelor of Secondary Education major in Filipino" data-dept="School of Arts, Sciences, and Education">Bachelor of Secondary Education major in Filipino</option>
      <option value="Bachelor of Secondary Education major in Mathematics" data-dept="School of Arts, Sciences, and Education">Bachelor of Secondary Education major in Mathematics</option>
      <option value="Bachelor of Secondary Education major in Science" data-dept="School of Arts, Sciences, and Education">Bachelor of Secondary Education major in Science</option>
      <option value="Bachelor of Library and Information Science" data-dept="School of Arts, Sciences, and Education">Bachelor of Library and Information Science</option>

      <!-- Tourism and Hospitality -->
      <option value="Bachelor of Science in Tourism Management" data-dept="School of Tourism and Hospitality Management">Bachelor of Science in Tourism Management</option>
      <option value="Bachelor of Science in Hospitality Management" data-dept="School of Tourism and Hospitality Management">Bachelor of Science in Hospitality Management</option>

      <!-- Criminal Justice -->
      <option value="Bachelor of Science in Criminology" data-dept="School of Criminal Justice">Bachelor of Science in Criminology</option>
    </select>
  </div>
</div>

<script>
  const departmentSelect = document.getElementById('departmentSelect');
  const categorySelect = document.getElementById('categorySelect');
  const allProgramOptions = Array.from(categorySelect.options);

  departmentSelect.addEventListener('change', () => {
    const selectedDept = departmentSelect.value;

    categorySelect.disabled = false;
    categorySelect.innerHTML = '<option selected disabled value="">Choose...</option>';

    allProgramOptions.forEach(option => {
      if (option.dataset.dept === selectedDept) {
        categorySelect.appendChild(option);
      }
    });
  });
</script>



      <!-- Abstract -->
      <div class="mb-3">
        <label for="abstract" class="form-label">Abstract</label>
        <textarea class="form-control" id="abstract" name="abstract" rows="4" placeholder="Enter your abstract here" required></textarea>
      </div>

      <!-- Visible textarea to show extracted PDF text -->
      <div class="mb-3" style="display: none;">
        <textarea class="form-control" id="pdfText" name="ocrPdf" rows="10" placeholder="Extracted text will appear here..."></textarea>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-outline-primary">Upload</button>
    </form>

  </div>
</div>


    </div>
  </div>
</main>

<!-- Footer -->
<?php include '../css/footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- pdf.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.9.179/pdf.min.js"></script>

<script>
  const pdfFileInput = document.getElementById('pdfFile');
  const pdfTextArea = document.getElementById('pdfText');

  pdfFileInput.addEventListener('change', async (event) => {
    const file = event.target.files[0];

    if (!file || file.type !== 'application/pdf') {
      pdfTextArea.value = '';
      return;
    }

    try {
      const arrayBuffer = await file.arrayBuffer();
      const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;

      let fullText = '';

      for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
        const page = await pdf.getPage(pageNum);
        const textContent = await page.getTextContent();
        const pageText = textContent.items.map(item => item.str).join(' ');
        fullText += pageText + '\n\n';
      }

      // Show extracted text inside visible textarea
      pdfTextArea.value = fullText;

    } catch (error) {
      console.error('PDF text extraction error:', error);
      pdfTextArea.value = ''; // clear on error
    }
  });
</script>

</body>
</html>

<?php
} else {
  $_SESSION['error'] = "Invalid Token";
  header('Location: ../');
}
?>
