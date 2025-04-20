<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

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
        <li class="nav-links"><a href="<?php echo URLROOT ?>/ParentStudent/details"><i class="fa-solid fa-user-graduate icon"></i><span class="text nav-text">Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Academic/academic_details"><i class="fa-solid fa-chalkboard-user icon"></i><span class="text nav-text">Academic Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/ViewAttendance/attendanceParent"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Attendance Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Payment_charges/paymentParent"><i class="fa-solid fa-credit-card icon"></i><span class="text nav-text">Payment Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/timeTable"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Timetable</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/events"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Scheduled Events</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/charges_form"><i class="fa-solid fa-file icon"></i><span class="text nav-text">Charges Form</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/report"><i class="fa-solid fa-comment icon"></i><span class="text nav-text">Report</span></a></li> 
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Users/settings"><i class="fa-solid fa-gear icon"></i><span class="text nav-text">Settings</span></a></li>

    </ul>
</nav>

<!-- Main Content -->
<div class="aca-container">
    <h1 style="text-align:center;">Student Marks</h1>

    <!-- Form to Enter Student ID -->
    <form action="<?= URLROOT ?>/Academic/academic_details" method="POST" style="text-align:center; margin-bottom: 30px;">
        <label for="student_id">Enter Student ID:</label>
        <input type="text" name="student_id" id="student_id" value="<?= htmlspecialchars($data['studentId'] ?? '') ?>" required>
        <button type="submit">View Marks</button>
    </form>

    <!-- Display error -->
    <?php if (!empty($data['error'])): ?>
        <p style="color:red; text-align:center;"><?= htmlspecialchars($data['error']) ?></p>
    <?php endif; ?>

    <?php
$groupedMarks = [];

if (!empty($data['marks']) && is_array($data['marks'])) {
    foreach ($data['marks'] as $mark) {
        $term = $mark->term;
        if (!isset($groupedMarks[$term])) {
            $groupedMarks[$term] = [];
        }
        $groupedMarks[$term][] = $mark;
    }
}
?>


<?php if (!empty($groupedMarks)) : ?>
    <?php foreach ($groupedMarks as $term => $marks) : ?>
        <h2 style="margin-top: 20px;">Term <?= htmlspecialchars( $term) ?> - <?= htmlspecialchars($_POST['student_id'] ?? '') ?>
        </h2>
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
    <!-- <p>No marks available.</p> -->
<?php endif; ?>

</div>

</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>