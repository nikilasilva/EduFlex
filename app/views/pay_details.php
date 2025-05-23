<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Status Table</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/payment.css">
</head>

<nav class="sidebar">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="<?php echo URLROOT; ?>/public/img/logo_noBG1.png" alt="Logo">
            </span>
            <div class="text header-text">
            <span class="name">EduFlex</span>
            </div>
            <i class="fa-solid fa-bars toggle"></i>
        </div>
    </header>

    <ul>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Dashboard/index"><i class="fa-solid fa-house icon"></i><span class="text nav-text">Home</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/details"><i class="fa-solid fa-user-graduate icon"></i><span class="text nav-text">Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/academic"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Academic Details</span></a></li>
        <li class="nav-links"><a href="#attendance"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Attendance Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/payment"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Payment Details</span></a></li>
        <li class="nav-links"><a href="#timetable"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Timetable</span></a></li>
        <li class="nav-links"><a href="#scheduled events"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Scheduled Events</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/certificate"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Certificates</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/form"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Charges Form</span></a></li>
    </ul>
</nav>

<body>
    <div class="table-container">
        <h2>Facility & Service Charges</h2>
        
        <div class="status-table">
            <!-- Headers -->
            <div class="table-header">Year</div>
            <div class="table-header">Status</div>

            <!-- Year and Status Cells -->
            <div class="year-cell">2021</div>
            <div class="status-paid">Paid</div>

            <div class="year-cell">2022</div>
            <div class="status-paid">Paid</div>

            <div class="year-cell">2023</div>
            <div class="status-paid">Paid</div>

            <div class="year-cell">2024</div>
            <div class="status-paid">Paid</div>

            <div class="year-cell">2025</div>
            <div class="status-non-paid">Non Paid</div>

            <div class="year-cell">2026</div>
            <div class="status-non-paid">Non Paid</div>
        </div>
    </div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
