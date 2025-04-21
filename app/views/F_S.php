<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility & Service Charges</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/libry_fine.css">
</head>
<body>
    <!-- Notification div to display the success message -->
    <div id="notification" class="notification">File uploaded successfully!</div>

    <div class="form-container">
        <h2>Facility & Service Charges</h2>
        <form id="fineForm" action="#" method="post" onsubmit="showNotification(event)">
            <label for="fullName">1. Full Name</label>
            <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>

            <label for="studentId">2. Student ID</label>
            <input type="text" id="studentId" name="studentId" placeholder="Enter your student ID" required>

            <label for="PaymentYear">3. Year Of Payment</label>
            <input type="text" id="payment" name="payment" placeholder="Enter the Year Of Payment" required>

            <label for="paymentSlip">4. Payment Slip</label>
            <div class="file-upload">
                <input type="file" id="paymentSlip" name="paymentSlip" required onchange="updateLabel()">
                <label for="paymentSlip" id="uploadLabel" class="upload-label">Upload Slip <span class="upload-icon">📤</span></label>
            </div>

            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>

    <script>
        function updateLabel() {
            const fileInput = document.getElementById("paymentSlip");
            const label = document.getElementById("uploadLabel");

            if (fileInput.files.length > 0) {
                label.innerHTML = "Uploaded <span class='upload-icon'>✅</span>";
            } else {
                label.innerHTML = "Upload Slip <span class='upload-icon'>📤</span>";
            }
        }

        function showNotification(event) {
            event.preventDefault(); // Prevents the form from actually submitting
            document.getElementById("notification").style.display = "block";
            setTimeout(() => {
                document.getElementById("notification").style.display = "none";
            }, 3000); // Hides notification after 3 seconds
        }
    </script>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
