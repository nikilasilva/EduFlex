<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="fcontainer">
    <div class="forgot-password-container">
        <div class="logo">
            <span>EduFlex</span>
        </div>
        <div class="forgot-password-card">
            <h2>Reset Password</h2>
            
            <?php if (isset($data['error'])): ?>
                <div class="alert alert-danger"><?php echo $data['error']; ?></div>
            <?php endif; ?>
            
            <?php if (!isset($data['error']) && isset($data['token'])): ?>
                <form method="post" action="<?php echo URLROOT; ?>/users/resetPassword">
                    <input type="hidden" name="token" value="<?php echo $data['token']; ?>">
                    <input type="hidden" name="regNo" value="<?php echo $data['regNo']; ?>">
                    
                    <div class="forgotPassword-input-group">
                        <input type="password" name="password" placeholder="New Password" required>
                        <?php if (isset($data['errors']['password'])): ?>
                            <span class="error"><?php echo $data['errors']['password']; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="forgotPassword-input-group">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                        <?php if (isset($data['errors']['confirm_password'])): ?>
                            <span class="error"><?php echo $data['errors']['confirm_password']; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <button type="submit" class="reset-button">Reset Password</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="form-footer">
<?php require APPROOT.'/views/inc/footer.php'; ?>
</div>