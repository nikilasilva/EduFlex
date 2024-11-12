<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
</head>
<body>

    <!-- Container for the image cards -->
    <div class="cards-container">
        <div class="card">
            <a href="<?php echo URLROOT; ?>/Student/library_fine">
                <img src="../public/img/Library_fine.jpg" alt="Library Fine">
                <div class="card-text">
                    <p>Library Fine</p>
                </div>
            </a>
        </div>
        
        <div class="card">
            <a href="<?php echo URLROOT; ?>/Student/f_s">
                <img src="../public/img/Facility.jpg" alt="F&S Charges">
                <div class="card-text">
                    <p>F&S Charges</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Account details section without link -->
    <div class="account-details">
        <h2>Account Details</h2>
        <p>A/C Number : 202-23-56-98-0</p>
        <p>A/C Name : University of Colombo</p>
        <p>Commercial Credit, Reid Avenue, Colombo 07</p>
    </div>

</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
