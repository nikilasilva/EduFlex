<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="attendance-container">
    <h1>Attendance Records for <?php echo htmlspecialchars($data['date']); ?></h1>
    <h2>Class: <?php echo htmlspecialchars($data['class']); ?></h2>

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
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

