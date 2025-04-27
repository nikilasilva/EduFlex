<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="select-class-container container ">
    <h1>Select Class & Term</h1>

    <?php if (isset($_SESSION['error'])): ?>
        <div style="color: red; font-weight: bold; margin-bottom: 10px;">
            <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="<?php echo URLROOT; ?>/teacher/submitMarks" method="POST">
        <div class="form-group">
            <label for="class">Select Class:</label>
            <?php if (!empty($data['classes'])): ?>
                <select name="classId" id="class" class="form-control">
                    <option value="">-- Select Class --</option>
                    <?php foreach ($data['classes'] as $class): ?>
                        <option value="<?php echo htmlspecialchars($class->classId); ?>">
                            <?php echo htmlspecialchars($class->className); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php else: ?>
                <p>No classes available.</p>
            <?php endif; ?>
        </div>

        <div class="form-group mt-3">
            <label for="term">Select Term:</label>
            <select name="term" id="term" class="form-control">
                <option value="">-- Select Term --</option>
                <option value="1">Term 1</option>
                <option value="2">Term 2</option>
                <option value="3">Term 3</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Submit</button>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>