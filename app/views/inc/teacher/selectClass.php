<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<div class="container">
    <h1>Select Class</h1>
    <form action="<?php echo URLROOT; ?>/teacher/submitMarks" method="POST">
        <div class="form-group">
            <label for="class">Select Class:</label>
            <?php if (!empty($data['classes'])): ?>
                <select name="class_id" id="class" class="form-control" required>
                    <option value="">-- Select Class --</option>
                    <?php foreach ($data['classes'] as $class): ?>
                        <option value="<?php echo htmlspecialchars($class->id); ?>">
                            <?php echo htmlspecialchars($class->name); ?>
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