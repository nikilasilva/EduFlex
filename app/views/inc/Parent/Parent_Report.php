<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback & Attendance Report</title>
    <style>
        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 10px;
            border-radius: 10px;
            width: 80%;
            height: 80%;
            position: relative;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 25px;
            cursor: pointer;
            color: red;
        }
        iframe {
            width: 100%;
            height: 90%;
            border: none;
        }
    </style>
</head>
<body>
    <div class="feedback-title">
        <h1>Feedback & Attendance Report</h1>
    </div>

    <div class="feedback-cards-container">
        <div class="report-card">
            <a href="#" onclick="openModal('<?php echo URLROOT; ?>/Parents/feedback')">
                <img src="../public/img/Library_fine.jpg" alt="Library Fine">
                <div class="card-text">
                    <p> Add Feedbacks</p>
                </div>
            </a>
        </div>
        
        <div class="report-card">
            <a href="#" onclick="openModal('<?php echo URLROOT; ?>/Parents/absences')">
                <img src="../public/img/Facility.jpg" alt="F&S Charges">
                <div class="card-text">
                    <p>Report Absences</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Modal Popup -->
    <div id="feedbackModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <iframe id="modalIframe" src=""></iframe>
        </div>
    </div>

    <script>
        function openModal(pageURL) {
            document.getElementById("modalIframe").src = pageURL;
            document.getElementById("feedbackModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("feedbackModal").style.display = "none";
            document.getElementById("modalIframe").src = "";
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById("feedbackModal");
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
