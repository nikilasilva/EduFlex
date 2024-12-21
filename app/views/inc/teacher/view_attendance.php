<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<div class="layout">
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

    <div class="attendance-container">
        <h1>Attendance for <?php echo htmlspecialchars($data['date']); ?></h1>

        <?php if (!empty($data['attendanceRecords'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['attendanceRecords'] as $record): ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars(is_array($record) ? $record['student_id'] : $record->student_id); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars(is_array($record) ? $record['name'] : $record->name); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars(is_array($record) ? $record['class'] : $record->class); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars(is_array($record) ? $record['status'] : $record->status); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No attendance records found for this date.</p>
        <?php endif; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?> 

