


<?php
session_start();

require APPROOT . '/views/inc/header.php'; 
require APPROOT . '/views/inc/components/topNavbar.php';
require APPROOT.'/views/inc/components/sideBar.php'; 
?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/feedbackStyles.css">

<div class="feedback-set-container">
    <h1>Parents Feedbacks</h1>

    <!-- Display Feedbacks for Principal -->
    <?php if (isset($data['feedbacks']) && count($data['feedbacks']) > 0): ?>
        <?php foreach ($data['feedbacks'] as $feedback): ?>
            <div class="feedback-card">
                <!-- Feedback Content -->
                <textarea
                class="feedback-content fixed-space" 
                    readonly
                
                  ><?php echo htmlspecialchars($feedback->content); ?></textarea>

                <!-- Feedback Date -->
                <div class="feedback-date">Submitted on: <?php echo $feedback->date; ?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No feedbacks available.</p>
    <?php endif; ?>
</div>





<?php require APPROOT.'/views/inc/footer.php'; ?>