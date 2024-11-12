<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request for Character Certificate</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/leaving.css">
</head>
<body>

<div class="form-container">
    <h2>Request for Character Certificate</h2>
    <form onsubmit="showNotification(event)">
        <div class="form-group">
            <label for="full-name">1. Full Name </label>
            <input type="text" id="full-name" placeholder="Enter full name">
        </div>

        <div class="form-group">
            <label for="student-id">2. Student ID</label>
            <input type="text" id="student-id" placeholder="Enter student ID">
        </div>

        <div class="form-group">
            <label for="dob">3. Date of Birth</label>
            <input type="date" id="dob">
        </div>

        <div class="form-group">
            <label for="guardian-name">4. Guardian Name</label>
            <input type="text" id="guardian-name" placeholder="Enter guardian name">
        </div>

        <div class="form-group">
            <label for="address">6.Address <Address></Address></label>
            <textarea id="address" placeholder="Enter address"></textarea>
        </div>

        <div class="form-group">
            <div class="file-upload">
                <input type="file" id="paymentSlip" name="paymentSlip" required onchange="updateLabel()">
                <label for="paymentSlip" id="uploadLabel" class="upload-label">Class Teacher's Declaration <span class="upload-icon">📤</span></label>
            </div> 
        </div>

        <div class="checkbox-container">
            <input type="checkbox" id="declaration">
            <span>I hereby declare that the information provided is true and correct.</span>
        </div>

        <button type="submit" class="submit-btn">Submit</button>
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
        event.preventDefault();
        document.getElementById("notification").style.display = "block";
        setTimeout(() => {
            document.getElementById("notification").style.display = "none";
        }, 3000);
    }
</script>

</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
