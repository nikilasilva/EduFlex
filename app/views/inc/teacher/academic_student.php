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

<!-- Main Content -->
<div class="aca-container">
    <h1>All Subjects</h1>
    <div class="search-bar">
        <input type="text" placeholder="Search by subject name..." id="searchInput">
        <button>SEARCH</button>
    </div>
    
    <table>
    <thead class="academic-table-header">
        <tr>
            <th class="academic-header-cell">Subject Name</th>
            <th class="academic-header-cell">Teacher</th>
            <th class="academic-header-cell">Grade</th>
        </tr>
    </thead>
        <tbody id="subjectTable">
            <tr>
                <td>English</td>
                <td>Daniel Grant</td>
                <td>View Grade</td>
            </tr>
            <tr>
                <td>Maths</td>
                <td>Daniel Grant</td>
                <td>View Grade</td>
            </tr>
            <tr>
                <td>French</td>
                <td>Daniel Grant</td>
                <td>View Grade</td>
            </tr>
            <tr>
                <td>Science</td>
                <td>Daniel Grant</td>
                <td>View Grade</td>
            </tr>
            <tr>
                <td>Arts</td>
                <td>Daniel Grant</td>
                <td>View Grade</td>
            </tr>
            <tr>
                <td>French</td>
                <td>Daniel Grant</td>
                <td>View Grade</td>
            </tr>
            <tr>
                <td>Science</td>
                <td>Daniel Grant</td>
                <td>View Grade</td>
            </tr>
            <tr>
                <td>Arts</td>
                <td>Daniel Grant</td>
                <td>View Grade</td>
            </tr>
        </tbody>
    </table>

    
    
</div>

</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
