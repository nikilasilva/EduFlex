<?php
session_start(); // Start session handling
require APPROOT.'/views/inc/header.php';
require APPROOT.'/views/inc/components/topNavbar.php';
require APPROOT.'/views/inc/components/sideBar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character Certificate Form</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/libry_fine.css">
</head>
<body>

    <!-- Error Notification -->
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="notification error">
            <?php echo htmlspecialchars($_SESSION['error']); ?>
        </div>
        <?php unset($_SESSION['error']); // Clear error after displaying ?>
    <?php endif; ?>

    <div class="form-container">
        <h2>Character Certificate Application</h2>
        <form id="characterCertificateForm" method="post" action="<?= URLROOT ?>/CharacterCertificate/submit" enctype="multipart/form-data" onsubmit="return validateForm()">
            
            <!-- Full Name Field -->
            <label for="fullName">1. Full Name</label>
            <input type="text" 
                   id="fullName" 
                   name="fullName" 
                   placeholder="Enter your full name" 
                   value="<?php echo $data['full_name'] ?? ''; ?>" 
                   required>
            
            <!-- Student ID Field -->
            <label for="studentId">2. Student ID</label>
            <input type="text" 
                   id="studentId" 
                   name="studentId" 
                   placeholder="Enter your student ID" 
                   value="<?php echo $data['student_id'] ?? ''; ?>" 
                   required>
            
            <!-- Date of Birth Field -->
            <label for="dob">3. Date of Birth</label>
            <input type="date" 
                   id="dob" 
                   name="dob" 
                   value="<?php echo $data['date_of_birth'] ?? ''; ?>" 
                   required>
            
            <!-- Guardian Name Field -->
            <label for="guardianName">4. Guardian Name</label>
            <input type="text" 
                   id="guardianName" 
                   name="guardianName" 
                   placeholder="Enter guardian's name" 
                   value="<?php echo $data['guardian_name'] ?? ''; ?>" 
                   required>
            
            <!-- Address Field -->
            <label for="address">5. Address</label>
            <input type="text" 
                   id="address" 
                   name="address" 
                   placeholder="Enter your address" 
                   value="<?php echo $data['address'] ?? ''; ?>" 
                   required>
            
            <!-- Payment Slip (File Upload) -->
            <label for="paymentSlip">6. ID Copy</label>
            <div class="file-upload">
                <input type="file" 
                       class="fine-input" 
                       id="slip" 
                       name="slip" 
                       required 
                       onchange="updateLabel()">
                <label for="slip" 
                       id="uploadLabel" 
                       class="upload-label">
                    Upload Copy of ID <span class="upload-icon">📤</span>
                </label>
            </div>

            <!-- Checkbox: Terms and Conditions (or agreement) -->
            <label for="agreeCheckbox" class="checkbox-label">
                <input type="checkbox" 
                       id="agreeCheckbox" 
                       name="agreeCheckbox" 
                       value="1"> I agree to the terms and conditions
            </label>

            <!-- Submit Button -->
            <button type="submit" class="charges-submit-button">Submit</button>
        </form>
    </div>

    <script>
        // Update file label when user selects a file
        function updateLabel() {
            const fileInput = document.getElementById("slip");
            const label = document.getElementById("uploadLabel");
            
            if (fileInput.files.length > 0) {
                label.innerHTML = fileInput.files[0].name + " <span class='upload-icon'>✅</span>";
            } else {
                label.innerHTML = "Upload Slip <span class='upload-icon'>📤</span>";
            }
        }

        // Checkbox validation before submission
        function validateForm() {
            const checkbox = document.getElementById("agreeCheckbox");
            if (!checkbox.checked) {
                alert("You must agree to the terms and conditions before submitting.");
                return false;
            }
            return true;
        }
    </script>

</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
