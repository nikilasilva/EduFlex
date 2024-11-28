<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/student/all_students_table.php';?>

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

<?php require APPROOT.'/views/inc/footer.php'; ?>