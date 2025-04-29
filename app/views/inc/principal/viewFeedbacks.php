<?php
session_start();

require APPROOT . '/views/inc/header.php'; 
require APPROOT . '/views/inc/components/topNavbar.php';
require APPROOT . '/views/inc/components/sideBar.php'; 
?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/feedbackStyles.css">

<div class="feedback-set-container container">
    <h1>Parents Feedbacks</h1>

    <!-- Display Feedbacks for Principal -->
    <?php if (isset($data['feedbacks']) && count($data['feedbacks']) > 0): ?>
        <?php foreach ($data['feedbacks'] as $feedback): ?>
            <div class="feedback-card">
                <!-- Feedback Content -->
                <textarea class="feedback-content fixed-space" readonly><?php echo htmlspecialchars($feedback->content); ?></textarea>

                <!-- Feedback Date -->
                <div class="feedback-date">Submitted on: <?php echo $feedback->date; ?></div>

                <div class="feedback-read-section">
                    <form action="<?php echo URLROOT; ?>/Principal/markFeedbackAsRead" method="POST">
                        <input type="hidden" name="feedback_id" value="<?php echo $feedback->feedback_id; ?>">
                        <div class="read-checkbox-container">
                            <input 
                                type="checkbox" 
                                id="feedback-<?php echo $feedback->feedback_id; ?>" 
                                name="is_read" 
                                <?php echo $feedback->is_read ? 'checked' : ''; ?>
                                onchange="this.form.submit()"
                            >
                            <label for="feedback-<?php echo $feedback->feedback_id; ?>">
                                Mark as Read
                            </label>
                        </div>
                    </form>
                </div>

                <!-- Delete Button -->
                <button 
                    class="btn btn-edit btn-danger" 
                    onclick="window.location.href='<?php echo URLROOT; ?>/parents/deleteFeedback_Principal/<?php echo $feedback->feedback_id; ?>';"
                >
                    Delete
                </button>
                
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No feedbacks available.</p>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
