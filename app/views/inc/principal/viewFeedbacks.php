<?php
session_start();

require APPROOT . '/views/inc/header.php'; 
require APPROOT . '/views/inc/components/topNavbar.php';
require APPROOT . '/views/inc/components/sideBar.php'; 
?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/feedbackStyles.css">

<div class="feedback-set-container">
    <h1>Parents Feedbacks</h1>

    <!-- Display Feedbacks for Principal -->
    <?php if (isset($data['feedbacks']) && count($data['feedbacks']) > 0): ?>
        <?php foreach ($data['feedbacks'] as $feedback): ?>
            <div class="feedback-card">
                <!-- Feedback Content -->
                <textarea class="feedback-content fixed-space" readonly><?php echo htmlspecialchars($feedback->content); ?></textarea>

                <!-- Feedback Date -->
                <div class="feedback-date">Submitted on: <?php echo $feedback->date; ?></div>

                <!-- Mark as Read Checkbox -->
                <form action="<?php echo URLROOT; ?>/parents/toggleReadStatus/<?php echo $feedback->feedback_id; ?>" method="POST">
                    <label for="is_read_<?php echo $feedback->feedback_id; ?>">Mark as Read:</label>
                    <input type="checkbox" 
                           id="is_read_<?php echo $feedback->feedback_id; ?>" 
                           name="is_read" 
                           <?php echo $feedback->is_read == 1 ? 'checked' : ''; ?>>
                    
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No feedbacks available.</p>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
