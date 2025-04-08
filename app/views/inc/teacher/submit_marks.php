<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<div class="submit-marks-container">
    <h1 class="form-title">Submit Marks</h1>

    <!-- Debugging output -->

    <form action="<?= URLROOT ?>/teacher/viewClassReport" method="POST">
        <input type="hidden" name="class" value="<?= $class ?? '' ?>">
        <table border="1" class="marks-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Student ID</th>

                    <?php if (!empty($subjects) && is_array($subjects)): ?>
                        <?php foreach ($subjects as $subject): ?>
                            <th><?= htmlspecialchars($subject->name) ?></th>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <th colspan="2">No Subjects Found</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($students) && is_array($students)): ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= htmlspecialchars($student->name) ?></td>
                            <td><?= htmlspecialchars($student->student_id) ?></td>
                            <?php foreach ($subjects as $subject): ?>
                                <td>
                                    <input type="number" 
                                           name="marks[<?= $student->student_id ?>][<?= $subject->id ?>]" 
                                           required>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="<?= count($subjects) + 2 ?>">No Students Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <button type="submit">Submit Marks</button>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
