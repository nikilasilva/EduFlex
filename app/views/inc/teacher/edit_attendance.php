<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>


<form action="<?php echo URLROOT; ?>/teacher/updateAttendance" method="POST">
    <input type="hidden" name="date" value="<?= htmlspecialchars($data['date']) ?>">
    <input type="hidden" name="class" value="<?= htmlspecialchars($data['class']) ?>">

    <div class="attendance-container container">
        <h1>Attendance Records for <?= htmlspecialchars($data['date']); ?></h1>
        <h2>Class: <?= htmlspecialchars($data['className']); ?></h2>

        <table border="1" class="attendance-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['attendanceRecords'] as $record): ?>
                    <tr>
                        <td><?= htmlspecialchars($record['student_id']) ?></td>
                        <td>
                            <?= htmlspecialchars($record['name']) ?>
                            <input type="hidden" name="student_name[<?= $record['student_id'] ?>]" 
                                value="<?= htmlspecialchars($record['name']) ?>">
                        </td>
                        <td>
                            <div style="display: flex; gap: 20px; align-items: center;">
                                <label>
                                    <input type="radio" name="status[<?= $record['student_id'] ?>]" value="Present"
                                        <?= $record['status'] === 'Present' ? 'checked' : '' ?>> Present
                                </label>
                                <label>
                                    <input type="radio" name="status[<?= $record['student_id'] ?>]" value="Absent"
                                        <?= $record['status'] === 'Absent' ? 'checked' : '' ?>> Absent
                                </label>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <br>
        <button type="submit" class="btn btn-primary">Submit Updates</button>
    </div>
</form>

<?php require APPROOT . '/views/inc/footer.php'; ?>
