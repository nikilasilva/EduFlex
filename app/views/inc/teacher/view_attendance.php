<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="attendance-container">
    <h1>Attendance Records for <?php echo htmlspecialchars($data['date']); ?></h1>
    <h2>Class: <?php echo htmlspecialchars($data['className']); ?></h2>

    <?php if (!empty($data['errors'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($data['errors']) ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php if ($_GET['success'] === 'submitted'): ?>
                Attendance has been submitted successfully.
            <?php elseif ($_GET['success'] === 'updated'): ?>
                Attendance has been updated successfully.
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['attendanceRecords'])): ?>
                <?php foreach ($data['attendanceRecords'] as $record): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($record['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($record['name']); ?></td>
                        <td><?php echo htmlspecialchars($record['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No attendance records found for this date and class.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php
    $canUpdate = (strtotime(date('Y-m-d')) - strtotime($data['date'])) <= 604800; // 7 * 24 * 60 * 60
    ?>

    <?php if ($canUpdate): ?>
        <form action="<?php echo URLROOT; ?>/teacher/editAttendance" method="POST">
            <input type="hidden" name="date" value="<?= htmlspecialchars($data['date']) ?>">
            <input type="hidden" name="class" value="<?= htmlspecialchars($data['class']) ?>">
            <button type="submit" class="btn btn-info">Update Attendance</button>
        </form>
    <?php endif; ?>

    <a href="<?php echo URLROOT; ?>/teacher/selectClassForAttendance" class="btn-back">
    << Back
    </a>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

