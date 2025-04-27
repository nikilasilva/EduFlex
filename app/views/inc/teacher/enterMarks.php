<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="layout">
    <h1>Enter Marks for <?php echo htmlspecialchars($data['classDetails']->name); ?></h1>

    <form action="<?php echo URLROOT; ?>/teacher/saveStudentMarks" method="POST">
        <input type="hidden" name="class_id" value="<?php echo htmlspecialchars($data['classDetails']->id); ?>">

        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Subject</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['students'] as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student->id); ?></td>
                        <td><?php echo htmlspecialchars($student->name); ?></td>
                        <td>
                            <select name="subject_id[<?php echo $student->id; ?>]" required>
                                <?php foreach ($data['subjects'] as $subject): ?>
                                    <option value="<?php echo $subject->id; ?>">
                                        <?php echo htmlspecialchars($subject->name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="marks[<?php echo $student->id; ?>]" min="0" max="100" required>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit">Save Marks</button>
    </form>

    <a href="<?php echo URLROOT; ?>/teacher/selectClass" class="btn-back">
    << Back
</a>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
