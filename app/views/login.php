<?php require APPROOT.'/views/inc/header.php'; ?>
<div class="container">
    <div class="login-container">
        
        <div class="logo-section">
            <div class="logo">
                <!-- <img src="<?php echo URLROOT; ?>/public/img/logo_noBG1.png" alt="EduFlex Logo"> -->
                <span>EduFlex</span>
            </div>
        </div>
        <div class="content">
            <div class="left-section">
                <img src="<?php echo URLROOT; ?>/public/img/login.png" alt="Student Illustration" class="main-illustration">
            </div>
            
            <div class="right-section">
                <h1>WELCOME</h1>

                <!-- Error message -->
                <?php if (isset($data['error'])): ?>
                    <div class="error-message">
                        <?php echo $data['error']; ?>
                    </div>
                <?php endif; ?>

                <div class="login-form">
                    <form id="loginForm" action="<?php echo URLROOT; ?>/Login/login" method="POST">
                        <div class="input-group">
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-group">
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <div class="forgot-password">
                            <a href="<?php echo URLROOT; ?>/users/forgotPassword">Forgot your password?</a>
                        </div>
                        <button type="submit" class="sign-in-btn">SIGN IN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-footer">
<?php require APPROOT.'/views/inc/footer.php'; ?>
</div>
