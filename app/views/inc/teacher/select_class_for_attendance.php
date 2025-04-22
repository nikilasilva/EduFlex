<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="select-class-container">
    <h1>Select Class</h1>

    <?php if (!empty($_SESSION['error'])): ?>
    <div style="color: red; margin-bottom: 10px;">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<?php if (!empty($_SESSION['success'])): ?>
    <div style="color: green; margin-bottom: 10px;">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>


    <form action="<?php echo URLROOT; ?>/teacher/attendance" method="POST">
        <div class="form-group">
            <label for="class">Select Class:</label>
            <?php if (!empty($data['classes'])): ?>
                <select name="classId" id="class" class="form-control" required>
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
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>