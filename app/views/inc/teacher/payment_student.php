<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Subjects</title>
    
</head>
<body>

<!-- Sidebar -->
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
            <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/students"><i class="fa-solid fa-user-graduate icon"></i><span class="text nav-text">Students</span></a></li>

            <li class="nav-links"><a href="<?php echo URLROOT ?>/Teacher/student_academic"><i class="fa-solid fa-chalkboard-user icon"></i><span class="text nav-text">Academic</span></a></li>
            <li class="nav-links"><a href="<?php echo URLROOT ?>/Teacher/student_attendance"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Attendance</span></a></li>
            <li class="nav-links"><a href="<?php echo URLROOT ?>/Teacher/student_payment"><i class="fa-solid fa-pen icon"></i><span class="text nav-text">Payment</span></a></li>

            <li class="nav-links"><a href="<?php echo URLROOT ?>/Teacher/teachers"><i class="fa-solid fa-chalkboard-user icon"></i><span class="text nav-text">Teachers</span></a></li>
            <li class="nav-links"><a href="<?php echo URLROOT ?>/Teacher/timeTable"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Timetable</span></a></li>
            <li class="nav-links"><a href="<?php echo URLROOT ?>/Teacher/attendance"><i class="fa-solid fa-pen icon"></i><span class="text nav-text">Mark attendance</span></a></li>
            <li class="nav-links"><a href="<?php echo URLROOT ?>/Teacher/events"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Scheduled Events</span></a></li>
            <li class="nav-links"><a href="#misReport"><i class="fa-solid fa-file icon"></i><span class="text nav-text">MIS Report</span></a></li>
            <li class="nav-links"><a href="<?php echo URLROOT ?>/Teacher/dailyActivities"><i class="fa-solid fa-business-time icon"></i><span class="text nav-text">Teacher's Record</span></a></li>
            
    </ul>
</nav>




    <div class="table-container">
        <h1>Facility & Service Charges</h1>
        
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