<form action="<?= URLROOT ?>/attendance/submit" method="POST">
    <table border="1" class="attendance-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Attendance Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students) && is_array($students)): ?>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student->student_id) ?></td>
                        <td><?= htmlspecialchars($student->name) ?></td>
                        <td>
                            <label>
                                <input type="radio" 
                                       name="attendance[<?= $student->student_id ?>]" 
                                       value="present" 
                                       required>
                                Present
                            </label>
                            &nbsp;&nbsp;
                            <label>
                                <input type="radio" 
                                       name="attendance[<?= $student->student_id ?>]" 
                                       value="absent">
                                Absent
                            </label>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No Students Found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary mt-3">Submit Attendance</button>
</form>
