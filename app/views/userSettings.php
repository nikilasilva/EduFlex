<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="user-settings-container">
    <div class="user-settings-header">
        <h1>Account Setting</h1>
    </div>
    <div class="user-settings-card">
        <div class="user-settings-banner">
            <img src="<?php echo URLROOT; ?>/public/img/accountBG.png" alt="Banner" class="user-settings-banner-img">
        </div>
        <div class="user-settings-avatar-section">
            <img src="<?php echo URLROOT; ?>/public/img/profileImg.png" alt="User Photo" class="user-settings-avatar">
            <h2>Prince Afful Quansah - Admin</h2>
        </div>

        <div>
            <?php if (!empty($data['message'])): ?>
            <p class="message"><?php echo htmlspecialchars($data['message']); ?></p>
            <?php endif; ?>
            <?php if (!empty($data['errors']['general'])): ?>
            <p class="error"><?php echo htmlspecialchars($data['errors']['general']); ?></p>
            <?php endif; ?>
        </div>

        <form class="update-password-form" method="POST" action="<?= URLROOT ?>/Users/updatePassword">
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" value="<?php echo htmlspecialchars($data['current_password'] ?? ''); ?>">
                <?php if (!empty($data['errors']['current_password'])): ?>
                    <span class="error"><?php echo htmlspecialchars($data['errors']['current_password']); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" value="<?php echo htmlspecialchars($data['new_password'] ?? ''); ?>">
                <?php if (!empty($data['errors']['new_password'])): ?>
                    <span class="error"><?php echo htmlspecialchars($data['errors']['new_password']); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" value="<?php echo htmlspecialchars($data['confirm_password'] ?? ''); ?>">
                <?php if (!empty($data['errors']['confirm_password'])): ?>
                    <span class="error"><?php echo htmlspecialchars($data['errors']['confirm_password']); ?></span>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn-save">Update Password</button>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>