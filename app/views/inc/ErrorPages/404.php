<?php require APPROOT.'/views/inc/header.php'; ?>

<div class="error-404-container">
    <div class="error-404-content">
        <h1 class="title-404">404 </h1>
        <h1> Not Found</h1>
        <p>The resource requested could not be found on this server!</p>
        <a href="<?php echo URLROOT ?>/Dashboard/index" class="error-404-button">Back to Homepage</a>
    </div>
    <div class="error-404-icon">
        <img class="error404-img" src="<?php echo URLROOT; ?>/public/img/404-img.png" alt="404 Illustration">
    </div>
</div>