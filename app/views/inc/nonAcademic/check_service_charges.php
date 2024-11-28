<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Fine Charges</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/libry_fine.css">

    <style>
        .download-button {
            background-color: #007bff;
            /* Blue background */
            color: white;
            /* White text */
            border: none;
            /* Remove borders */
            padding: 10px 20px;
            /* Add padding */
            font-size: 16px;
            /* Increase font size */
            cursor: pointer;
            /* Pointer cursor on hover */
            border-radius: 5px;
            /* Rounded corners */
            text-decoration: none;
            /* Remove underline from links */
            display: inline-block;
            /* Block display for spacing */
        }

        .download-button:hover {
            background-color: #0056b3;
            /* Darker blue on hover */
        }
    </style>


</head>

<body>
    <!-- Notification div to display the success message -->
    <div id="notification" class="notification">File uploaded successfully!</div>

    <div class="layout">
        <h2>Library Fine Charges</h2>
        <form id="fineForm" action="#" method="post" onsubmit="showNotification(event)">
            <label for="fullName">Name Of Student </label>
            <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>

            <label for="studentId">Student ID</label>
            <input type="text" id="studentId" name="studentId" placeholder="Enter your student ID" required>

            <label for="bookName">Date of pay</label>
            <input type="text" id="bookName" name="bookName" placeholder="Enter the book name" required>

            <!-- <label for="paymentSlip">Payment Slip</label>
            <div class="file-upload">
                <input type="file" id="paymentSlip" name="paymentSlip" required onchange="updateLabel()">
                <label for="paymentSlip" id="uploadLabel" class="upload-label">Upload Slip <span class="upload-icon">📤</span></label>
            </div> -->
            <br>
            <br>

            <!-- this button clas is difine temparry css inthe styls in this page -->
            <a href="path-to-payment-slip.pdf" class="download-button" download>
                Download Payment Slip PDF
            </a>
            <br><br>

            <label for="html">peyment is successfully</label>
            <input type="radio" id="html" name="fav_language" value="HTML">
            <br><br>
            <label for="css">peyment is not successfully</label>
            <input type="radio" id="css" name="fav_language" value="CSS">


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

<?php require APPROOT . '/views/inc/footer.php'; ?>