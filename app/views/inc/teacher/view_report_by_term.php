<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<div class="term-report-container">
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

    <h1 class="form-title">View Term Report</h1>

    <?php if (isset($_SESSION['error'])): ?>
        <div style="color: red; font-weight: bold; margin-bottom: 10px;">
            <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="<?= URLROOT ?>/teacher/selectClassForViewReport" method="POST">
        <div class="form-group">
            <label for="class">Select Class:</label>
            <select name="class" id="class">
                <option value="">--Select Class--</option>
                <?php foreach ($classes as $class): ?>
                    <option value="<?= $class->classId ?>"><?= htmlspecialchars($class->className) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="term">Select Term:</label>
            <select name="term" id="term">
                <option value="">--Select Term--</option>
                <option value="1">Term 1</option>
                <option value="2">Term 2</option>
                <option value="3">Term 3</option>
            </select>
        </div>

        <button type="submit">View Report</button>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>