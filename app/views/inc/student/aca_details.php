<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    
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
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Academic/academic"><i class="fa-solid fa-chalkboard-user icon"></i><span class="text nav-text">Academic Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/ViewAttendance/attendance"><i class="fa-solid fa-clipboard-user icon"></i></i><span class="text nav-text">Attendance Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Payment_charges/payment"><i class="fa-solid fa-credit-card icon"></i><span class="text nav-text">Payment Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/timeTable"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Timetable</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/events"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Scheduled Events</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/certificate"><i class="fa-solid fa-certificate icon"></i><span class="text nav-text">Certificates</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/form"><i class="fa-solid fa-file icon"></i><span class="text nav-text">Charges Form</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Users/settings"><i class="fa-solid fa-gear icon"></i><span class="text nav-text">Settings</span></a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="aca-container">
  
    <!-- <div class="search-bar">
        <input type="text" placeholder="Search by subject name..." id="searchInput">
        <button>SEARCH</button>
    </div> -->
    <h1>Your Academic Details</h1>

<?php
$groupedMarks = [];

foreach ($data['marks'] as $mark) {
    $term = $mark->term;
    if (!isset($groupedMarks[$term])) {
        $groupedMarks[$term] = [];
    }
    $groupedMarks[$term][] = $mark;
}
?>

<?php if (!empty($groupedMarks)) : ?>
    <?php foreach ($groupedMarks as $term => $marks) : ?>
        <h2 style="margin-top: 20px;">Term <?= htmlspecialchars( $term) ?></h2>
        <table>
            <thead class="academic-table-header">
                <tr>
                    <th class="academic-header-cell">Subject</th>
                    <th class="academic-header-cell">Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalMarks = 0;
                $count=0;
                foreach ($marks as $row):
                    $totalMarks += $row->marks;
                    $count++;
                
                ?>
                    <tr>
                        <td><?= htmlspecialchars($row->subjectName) ?></td>
                        <td><?= htmlspecialchars($row->marks) ?></td>
                    </tr>
                <?php endforeach; ?>
                <td><strong>Total</strong></td>
                <td><strong><?= $totalMarks ?></strong></td>
                <tr>
                <td><strong>Average</strong></td>
                <td><strong><?= round($totalMarks / max($count, 1), 2) ?></strong></td></tr>

            </tbody>
        </table>
    <?php endforeach; ?>
<?php else : ?>
    <p>No marks available.</p>
<?php endif; ?>

</div>

</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>











