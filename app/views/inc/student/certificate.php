<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/certificate.css">
    <title>Account Details</title>
</head>




<body>
    

    <!-- Container for the image cards -->
    <div class="certificate-container">
        <div class="certificate-card">
            <a href="<?php echo URLROOT; ?>/Student/leaving">
                <img src="<?php echo URLROOT; ?>/public/img/Library_fine.jpg" alt="Library Fine">
                <div class="certificate-card-text">
                    <p>Leaving Certificate</p>
                </div>
            </a>
        </div>
        
        <div class="certificate-card">
            <a href="<?php echo URLROOT; ?>/Student/character">
                <img src="<?php echo URLROOT; ?>/public/img/Facility.jpg" alt="F&S Charges">
                <div class="certificate-card-text">
                    <p>Character Certificate</p>
                </div>
            </a>
        </div>
    </div>

<?php require APPROOT.'/views/inc/footer.php'; ?>
