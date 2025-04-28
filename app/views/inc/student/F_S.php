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
    <!-- Error Notification -->
    <?php if(!empty($data['errors'])): ?>
        <div class="notification error">
            <?php foreach($data['errors'] as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="form-container container">
        <h2>Facility & Service Charges</h2>
        <form id="fineForm" method="post" action="<?= URLROOT ?>/payment_charges/submit" 
               
              enctype="multipart/form-data" novalidate>
            
            <div class="form-group">
            <label for="fullName">1. Full Name</label>
            <input type="text" 
                   id="fullName" 
                   name="fullName" 
                   placeholder="Enter your full name" 
                  
                   required>

                   <?php if (!empty($data['errors']['fullName'])): ?>
                        <span class="error"><?= htmlspecialchars($data['errors']['fullName']) ?></span>
                    <?php endif; ?>
            </div>
            
            <div class="form-group">
            <label for="studentId">2. Student ID</label>
            <input type="text" 
                   id="studentId" 
                   name="studentId" 
                   placeholder="Enter your student ID" 
                   
                   required>

                   <?php if (!empty($data['errors']['studentId'])): ?>
                        <span class="error"><?= htmlspecialchars($data['errors']['studentId']) ?></span>
                    <?php endif; ?>
            </div>
            
           <div class="form-group">

            <label for="payment">3. Year Of Payment</label>
            <input type="text" 
                   id="payment" 
                   name="payment" 
                   placeholder="Enter the Year Of Payment" 
                   
                   required>
            </div>
            <?php if (!empty($data['errors']['payment'])): ?>
                <span class="error"><?= htmlspecialchars($data['errors']['payment']) ?></span>
            <?php endif; ?>
                    
                    
                    <div class="form-group">
                        <label for="paymentSlip">4. Payment Slip</label>
                        <div class="file-upload">
                            <input type="file" 
                            class="fine-input" 
                       id="paymentSlip" 
                       name="paymentSlip" 
                       required 
                       onchange="updateLabel()">
                       
                       <label for="paymentSlip" 
                       id="uploadLabel" 
                       class="upload-label">
                       Upload Slip <span class="upload-icon">📤</span>
                    </label>
                    <?php if (!empty($data['errors']['paymentSlip'])): ?>
                        <span class="error"><?= htmlspecialchars($data['errors']['paymentSlip']) ?></span>
                        <?php endif; ?></div>
                    </div>
                
                <button type="submit" class="charges-submit-button">Submit</button>
        </form>
    </div>

    <script>
        function updateLabel() {
            const fileInput = document.getElementById("paymentSlip");
            const label = document.getElementById("uploadLabel");
            
            if (fileInput.files.length > 0) {
                label.innerHTML = fileInput.files[0].name + " <span class='upload-icon'>✅</span>";
            } else {
                label.innerHTML = "Upload Slip <span class='upload-icon'>📤</span>";
            }
        }
    </script>
</body>
</html>
<?php require APPROOT.'/views/inc/footer.php'; ?>