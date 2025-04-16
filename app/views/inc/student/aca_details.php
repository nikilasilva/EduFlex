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
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Users/details"><i class="fa-solid fa-user-graduate icon"></i><span class="text nav-text">Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/academic"><i class="fa-solid fa-chalkboard-user icon"></i><span class="text nav-text">Academic Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/attendance"><i class="fa-solid fa-clipboard-user icon"></i></i><span class="text nav-text">Attendance Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/payment"><i class="fa-solid fa-credit-card icon"></i><span class="text nav-text">Payment Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/timeTable"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Timetable</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/events"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Scheduled Events</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/certificate"><i class="fa-solid fa-certificate icon"></i><span class="text nav-text">Certificates</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/form"><i class="fa-solid fa-file icon"></i><span class="text nav-text">Charges Form</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Users/settings"><i class="fa-solid fa-gear icon"></i><span class="text nav-text">Settings</span></a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="aca-container">
    <h1>All Subjects</h1>
    <!-- <div class="search-bar">
        <input type="text" placeholder="Search by subject name..." id="searchInput">
        <button>SEARCH</button>
    </div> -->
    
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
                <td><a href="<?php echo URLROOT; ?>/Student/viewGrade/English">View Grade</a></td>
            </tr>
            <tr>
                <td>Maths</td>
                <td>Daniel Grant</td>
                <td><a href ="<?php echo URLROOT; ?>/Student/viewGrade/Maths">View Grade</a></td>
            </tr>
            <tr>
                <td>French</td>
                <td>Daniel Grant</td>
                <td><a href="<?php echo URLROOT; ?>/Student/viewGrade/French">View Grade</a></td>
            </tr>
            <tr>
                <td>Science</td>
                <td>Daniel Grant</td>
                <td><a href = "<?php echo URLROOT; ?>/Student/viewGrade/Science">View Grade</a></td>
            </tr>
            <tr>
                <td>Arts</td>
                <td>Daniel Grant</td>
                <td><a href = "<?php echo URLROOT; ?> /Student/viewGrade/Arts">View Grade</a></td>
            </tr>
            <tr>
                <td>French</td>
                <td>Daniel Grant</td>
                <td><a href = "<?php echo URLROOT; ?> /Student/viewGrade/French">View Grade</a></td>
            </tr>
            <tr>
                <td>Science</td>
                <td>Daniel Grant</td>
                <td><a href = "<?php echo URLROOT; ?> /Student/viewGrade/Science">View Grade</a></td>
            </tr>
            <tr>
                <td>Tamil</td>
                <td>Daniel Grant</td>
                <td><a href = "<?php echo URLROOT; ?> /Student/viewGrade/Tamil">View Grade</a></td>
            </tr>
        </tbody>
    </table>

    
    
</div>

</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
