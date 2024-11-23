<?php
// Start the session if it hasn't already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="topNav-container">
    <div class="topNav">
        <?php if (isset($_SESSION['user'])): ?>
            <!-- Display icons if user is logged in -->
            <div class="topNav-icons">
                <span class="topNav-icon"><a href="#"><i class="fa-solid fa-envelope icon"></i></a></span>
                <span class="topNav-icon"><a href="#"><i class="fa-solid fa-bell icon"></i></a></span>
                <span class="topNav-icon"><a href="#"><i class="fa-solid fa-user icon"></i></a></span>
            </div>
            <div class="topNav-logout">
                <a href="<?php echo URLROOT ?>/Login/logout" class="logout-button">Logout</a>
            </div>
        <?php else: ?>
            <!-- Display login button if user is not logged in -->
            <div class="topNav-login">
                <a href="<?php echo URLROOT ?>/Login/index" class="login-button">Login</a>
            </div>
        <?php endif; ?>
    </div>
</div>
