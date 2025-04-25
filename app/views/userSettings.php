<?php

use Soap\Url;

 require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="user-settings-container">
    <div class="user-settings-header">
        <h1>Account Setting</h1>
    </div>
    <div class="user-settings-card">
        <div class="settings-profile-header">
            <div class="user-settings-banner">
                <img src="<?php echo URLROOT; ?>/public/img/accountBG.png" alt="Banner" class="user-settings-banner-img">
            </div>
            <div class="user-settings-avatar-section">
                <?php
                // Create proper server path for file_exists check
                $profilePath = $_SESSION['user']['profile_picture'] ?? $data['profile_picture'] ?? '';
                $testPath = APPROOT . '/../' . $profilePath;              
                
                if (!empty($profilePath) && file_exists($testPath)) {
                    $imgSrc = URLROOT . '/' . ltrim($profilePath, '/');
                } else {
                    $imgSrc = URLROOT . '/public/img/profiles/default-profile.jpg';
                }
                ?>
                <img src="<?php echo $imgSrc; ?>" alt="User Photo" class="user-settings-avatar">
            </div>
        </div>
        <!-- form for change profile picture  -->
        <form action="<?php echo URLROOT; ?>/Users/settings" method="POST" enctype="multipart/form-data" class="user-settings-profile-pic-form">
            <h2><?php echo $_SESSION['user']['nameWithInitial']?> - <?php echo ucwords(strtolower($_SESSION['user']['role']))?></h2>
            <div class="form-group">
                <label for="profile_picture">Upload New Picture (JPEG/PNG, max 2MB):</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/jpeg,image/png">
                <?php if (!empty($data['errors']['profile_picture'])): ?>
                    <span class="error"><?php echo htmlspecialchars($data['errors']['profile_picture']); ?></span>
                <?php endif; ?>
            </div>
            <div class="profile-picture-buttons">
                <button type="submit" class="btn-update">Update Picture</button>
                <button type="button" class="btn-delete picture-delete-btn">Delete Picture</button>
            </div>
        </form>  

        <!-- Flash message -->
        <?php if(isset($data['message']) && !empty($data['message'])): ?>
        <div id="flash-message" class="alert alert-success">
            <?php echo $data['message']; ?>
        </div>
        <?php endif; ?>
        
        <?php if(isset($data['errors']['general']) && !empty($data['errors']['general'])): ?>
            <div id="flash-message" class="alert alert-danger">
                <?php echo $data['errors']['general']; ?>
            </div>
        <?php endif; ?>


        <!-- Delete Profile Picture Confirmation Modal -->
        <div id="delete-picture-modal" class="modal" aria-hidden="true">
            <div class="modal-content">
                <h3>Delete Profile Picture</h3>
                <p>Are you sure you want to delete your profile picture? This action cannot be undone.</p>
                <div class="modal-actions">
                    <button id="picture-delete-cancel" class="btn-cancel">Cancel</button>
                    <button id="picture-delete-confirm" class="btn-confirm-delete">Delete</button>
                </div>
            </div>
        </div>

        <!-- Hidden form for deletion -->
        <form id="delete-picture-form" style="display:none;" method="POST" action="<?php echo URLROOT; ?>/Users/deleteProfilePicture">
            <input type="hidden" name="delete_profile_picture" value="1">
        </form>

        <!-- form for update password  -->
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