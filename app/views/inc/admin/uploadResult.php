<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="upload-users-container">
    <h1>Upload Result</h1>
    <div class="upload-result">
        <?php if (isset($data['successCount']) && $data['successCount'] > 0): ?>
            <p class="success">Successfully added <?php echo htmlspecialchars($data['successCount']); ?> user(s).</p>
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
        <?php elseif (isset($data['message'])): ?>
            <p class="error"><?php echo htmlspecialchars($data['message']); ?></p>
        <?php endif; ?>
        <p>
            <a class="upload-again-btn" href="<?php echo URLROOT; ?>/SuperAdmin/uploadUsers">Upload another CSV</a>
        </p>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>