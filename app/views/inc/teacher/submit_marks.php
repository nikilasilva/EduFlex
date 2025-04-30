<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="submit-marks-container container">
    <h1 class="form-title">Submit Marks</h1>

    <!-- Display custom error messages -->
    <?php if (isset($_SESSION['error'])): ?>
        <div id="flash-message" class="alert alert-danger">
            <?= $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div id="flash-message" class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['error']) ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>


    <form action="<?= URLROOT ?>/teacher/processMarks" method="POST">
        <input type="hidden" name="class" value="<?= $class ?? '' ?>">

        <!-- Select Term -->
        <div class="form-group">
            <label for="term">Select Term:</label>
            <select name="term" id="term">
                <option value="">-- Select Term --</option>
                <option value="1" <?= (isset($term) && $term == 1) ? 'selected' : '' ?>>Term 1</option>
                <option value="2" <?= (isset($term) && $term == 2) ? 'selected' : '' ?>>Term 2</option>
                <option value="3" <?= (isset($term) && $term == 3) ? 'selected' : '' ?>>Term 3</option>
            </select>
        </div>

        <table border="1" class="marks-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <?php if (!empty($subjects) && is_array($subjects)): ?>
                        <?php foreach ($subjects as $subject): ?>
                            <th><?= htmlspecialchars($subject->subjectName) ?></th>
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
                            <td><?= htmlspecialchars($student->firstName) ?></td>
                            <td><?= htmlspecialchars($student->student_id) ?></td>
                            <?php foreach ($subjects as $subject): ?>
                                <td>
                                    <input type="number"
                                        name="marks[<?= $student->student_id ?>][<?= $subject->subjectId ?>]"
                                        min="0"
                                        max="100"
                                        value="<?= isset($_POST['marks'][$student->student_id][$subject->subjectId]) ? htmlspecialchars($_POST['marks'][$student->student_id][$subject->subjectId]) : '' ?>">
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

        <button type="submit" name="submit_marks">Submit Marks</button>
    </form>
    <a href="<?php echo URLROOT; ?>/teacher/selectClass" class="btn-back">
    << Back
</a>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>