<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Request for Leaving Certificate</title>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/leaving.css">
</head>
<body>

<div class="form-container">
  <h2>Request for Leaving Certificate</h2>

  <!-- Display errors if any -->
  <?php if (!empty($data['errors'])): ?>
    <div class="form-errors">
      <ul>
        <?php foreach ($data['errors'] as $error): ?>
          <li style="color: red;"><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form action="<?php echo URLROOT; ?>/LeavingCertificate/submit" method="POST">
    <div class="form-group">
      <label for="full-name">1. Full Name</label>
      <input type="text" name="fullName" id="full-name" placeholder="Enter full name"
             value="<?php echo htmlspecialchars($data['full_name'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
      <label for="student-id">2. Student ID</label>
      <input type="text" name="student_id" id="student-id" placeholder="Enter student ID"
             value="<?php echo htmlspecialchars($data['student_id'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
      <label for="dob">3. Date of Birth</label>
      <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($data['DOB'] ?? ''); ?>"
      max="<?php echo date('Y-m-d'); ?>"
       required>
    </div>

    <div class="form-group">
      <label for="admission-date">4. Admission Date</label>
      <input type="date" name="admissionDate" id="admission-date"
             value="<?php echo htmlspecialchars($data['Admission_date'] ?? ''); ?>" required>
    </div>

    <!-- <script>
  const dobInput = document.getElementById('dob');
  const admissionDateInput = document.getElementById('admission-date');
  const today = new Date().toISOString().split('T')[0];

  // Set the max date for admission date to today
  admissionDateInput.setAttribute('max', today);

  // Update admission date's min when DOB changes
  dobInput.addEventListener('change', function () {
    const dobValue = this.value;
    admissionDateInput.setAttribute('min', dobValue);
  });

  // Trigger on page load if dob is already filled
  if (dobInput.value) {
    admissionDateInput.setAttribute('min', dobInput.value);
  }
</script> -->

    <div class="form-group">
      <label for="reason">5. Reason for Leaving</label>
      <textarea name="reason" id="reason" placeholder="Enter reason for leaving" required><?php echo htmlspecialchars($data['Reason'] ?? ''); ?></textarea>
    </div>

    <div class="custom-checkbox-container">
      <input type="checkbox" id="customDeclaration" class="custom-checkbox" required>
      <span class="custom-checkbox-label">I hereby declare that the information provided is true and correct.</span>
    </div>

    <button type="submit" class="custom-submit-button">Submit</button>
  </form>
</div>

</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
