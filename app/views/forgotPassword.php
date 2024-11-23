<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="fcontainer">
    <div class="forgot-password-container">
        <div class="logo">
            <span>EduFlex</span>
        </div>
        <div class="forgot-password-card">
            <h2>Forgot Password</h2>
            <form method="post" action="<?php echo URLROOT; ?>/users/sendResetLink">
                <div class="forgotPassword-input-group">
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <button type="submit" class="reset-button">Send Reset Link</button>
            </form>
        </div>
    </div>
</div>
<div class="form-footer">
<?php require APPROOT.'/views/inc/footer.php'; ?>
</div>
