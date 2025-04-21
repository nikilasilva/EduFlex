<?php require APPROOT.'/views/inc/header.php'; ?>

<div class="error-403-container">
    <div class="error-403-content">
        <h1>403 Forbidden</h1>
        <p>You don't have permission to access this page.</p>
        <a href="<?php echo URLROOT ?>/Dashboard/index" class="error-403-button">Back to Homepage</a>
    </div>
    <div class="error-403-icon">
        <img class="error403-img" src="<?php echo URLROOT; ?>/public/img/403-img.png" alt="403 Illustration">
    </div>
</div>