<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="upload-timetable-container">
    <h1>Timetable Upload Result</h1>
    <div class="upload-result">
        <?php if (isset($data['successCount']) && $data['successCount'] > 0): ?>
            <p class="success">Successfully added <?php echo htmlspecialchars($data['successCount']); ?> timetable entries.</p>
        <?php endif; ?>
        
        <?php if (!empty($data['errors'])): ?>
            <div class="error-list">
                <p class="error">The following errors occurred:</p>
                <ul>
                    <?php foreach ($data['errors'] as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if (isset($data['message']) && !empty($data['message'])): ?>
            <p class="error"><?php echo htmlspecialchars($data['message']); ?></p>
        <?php endif; ?>
        
        <p>
            <a class="upload-again-btn" href="<?php echo URLROOT; ?>/Timetable/uploadTimetable">Upload another CSV</a>
            <!-- <a class="view-timetable-btn" href="<?php echo URLROOT; ?>/Timetable/viewTimetables">View Timetables</a> -->
        </p>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>