<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Class and Subject Selector</title>
  <!-- <link rel="stylesheet" href="styles.css"> -->
</head>
<body>

<div class="msi-container">
  <h2>Select Options</h2>
  
  <!-- Class Dropdown -->
  <div class="msi-form-group">
    <label for="class-select">Select Class:</label>
    <select id="class-select">
      <option value="">-- Choose a Class --</option>
      <option value="class-1">Class 1</option>
      <option value="class-2">Class 2</option>
      <option value="class-3">Class 3</option>
      <option value="class-4">Class 4</option>
    </select>
  </div>

  <!-- Subject Dropdown -->
  <div class="msi-form-group">
    <label for="subject-select">Select Subject:</label>
    <select id="subject-select">
      <option value="">-- Choose a Subject --</option>
      <option value="math">Math</option>
      <option value="science">Science</option>
      <option value="history">History</option>
      <option value="english">English</option>
    </select>
  </div>

  <!-- Download Button -->
  <div class="msi-form-group">
    <button id="download-btn">Download</button>
  </div>
</div>

</body>
</html>


<?php require APPROOT.'/views/inc/footer.php'; ?>