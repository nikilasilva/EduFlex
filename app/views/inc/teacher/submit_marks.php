<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<div class="submit-marks-container">
    <h1 class="form-title">Submit Marks</h1>

    <!-- Select Class -->
    <form method="GET" action="<?= URLROOT ?>/teacher/submitMarks">
        <label for="class">Select Class:</label>
        <select name="class" id="class" onchange="this.form.submit()" required>
            <option value="">-- Select Class --</option>
            <?php foreach ($data['classes'] as $class): ?>
                <option value="<?= htmlspecialchars($class['id']) ?>" <?= isset($_GET['class']) && $_GET['class'] == $class['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($class['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <!-- Show Students and Subjects -->
    <?php if (!empty($data['students']) && !empty($data['subjects'])): ?>
        <form method="POST" action="<?= URLROOT ?>/teacher/submitMarks">
            <input type="hidden" name="class" value="<?= htmlspecialchars($_GET['class']) ?>">
            
            <label for="subject">Select Subject:</label>
            <select name="subject" id="subject" required>
                <option value="">-- Select Subject --</option>
                <?php foreach ($data['subjects'] as $subject): ?>
                    <option value="<?= htmlspecialchars($subject['name']) ?>"><?= htmlspecialchars($subject['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="total_marks">Total Marks:</label>
            <input type="number" name="total_marks" id="total_marks" required>

            <h2 class="form-subtitle">Enter Marks</h2>
            <?php foreach ($data['students'] as $student): ?>
                <div class="student-marks-entry">
                    <label><?= htmlspecialchars($student['name']) ?> (<?= htmlspecialchars($student['student_id']) ?>):</label>
                    <input type="number" name="marks[<?= htmlspecialchars($student['student_id']) ?>]" required>
                </div>
            <?php endforeach; ?>

            <button class="submit-button" type="submit">Submit</button>
        </form>
    <?php elseif (isset($_GET['class'])): ?>
        <p>No students or subjects available for the selected class.</p>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>




