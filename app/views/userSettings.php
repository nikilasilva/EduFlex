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
        <form class="update-password-form" method="POST" action="<?= URLROOT ?>/users/updatePassword">
            <div class="form-group">
                <label for="current-password">Current Password *</label>
                <input type="password" id="current-password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new-password">New Password *</label>
                <input type="password" id="new-password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password *</label>
                <input type="password" id="confirm-password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn-save">Update Password</button>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>