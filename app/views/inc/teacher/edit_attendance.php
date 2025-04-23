<form action="<?php echo URLROOT; ?>/teacher/updateAttendance" method="POST">
    <input type="hidden" name="date" value="<?= htmlspecialchars($data['date']) ?>">
    <input type="hidden" name="class" value="<?= htmlspecialchars($data['class']) ?>">

    <table>
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
                <td><?= htmlspecialchars($record['name']) ?></td>
                <td>
                    <label>
                        <input type="radio" name="attendance[<?= $record['student_id'] ?>]" value="present"
                            <?= $record['status'] === 'present' ? 'checked' : '' ?>> Present
                    </label>
                    <label>
                        <input type="radio" name="attendance[<?= $record['student_id'] ?>]" value="absent"
                            <?= $record['status'] === 'absent' ? 'checked' : '' ?>> Absent
                    </label>
                    <input type="hidden" name="student_name[<?= $record['student_id'] ?>]" value="<?= htmlspecialchars($record['name']) ?>">
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Submit Updates</button>
</form>
