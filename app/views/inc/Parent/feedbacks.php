<?php
session_start();

require APPROOT . '/views/inc/header.php'; 
require APPROOT . '/views/inc/components/topNavbar.php'; 
?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/feedbackStyles.css">

<div class="feedback-set-container">
    <h1>Parents Feedbacks</h1>

    
    <!-- Display Existing Feedbacks -->
<?php if (!empty($data['feedbacks']) && is_array($data['feedbacks']) && count($data['feedbacks']) > 0): ?>
    <?php foreach ($data['feedbacks'] as $feedback): ?>
        <div class="feedback-card" id="feedback-<?php echo $feedback->feedback_id; ?>">
            <!-- Feedback Content -->
            <textarea 
                class="feedback-content fixed-space" 
                id="content-<?php echo $feedback->feedback_id; ?>" 
                readonly
            ><?php echo htmlspecialchars($feedback->content); ?></textarea

             Feedback Date -->
            <div class="feedback-date"><?php echo $feedback->date; ?></div>

            <!-- Update and Delete Buttons -->
            <div class="feedback-actions">
                <!-- Update Button -->
                <button 
                    id="update-btn-<?php echo $feedback->feedback_id; ?>" 
                    class="btn btn-warning" 
                    onclick="enableEditing(<?php echo $feedback->feedback_id; ?>);"
                >
                    Update
                </button>

                <!-- Delete Button -->
                <button 
                    class="btn btn-danger" 
                    onclick="window.location.href='<?php echo URLROOT; ?>/parents/deleteFeedback/<?php echo $feedback->feedback_id; ?>';"
                >
                    Delete
                </button>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No feedbacks available.</p>
<?php endif; ?>

   
    <!-- Add New Feedback Form -->
    <div class="submit-feedback">
        <form method="POST" action="<?php echo URLROOT; ?>/parents/submitFeedback">
            <textarea id="content" name="content" required placeholder="Add Your Feedback"></textarea>
            <button type="submit" class="btn btn-success colorful-submit">Submit Feedback</button>
        </form>
    </div>
</div>

<!-- JavaScript for Updating Feedback -->
<script>
    function enableEditing(feedbackId) {
        const contentField = document.getElementById(`content-${feedbackId}`);
        const updateButton = document.getElementById(`update-btn-${feedbackId}`);

        if (updateButton.innerText === 'Update') {
            // Enable Editing
            contentField.removeAttribute('readonly');
            contentField.focus();

            // Change Button to Submit
            updateButton.innerText = 'Submit';
            updateButton.classList.remove('btn-warning');
            updateButton.classList.add('colorful-submit');

            // Update Submit Functionality
            updateButton.onclick = function () {
                submitFeedback(feedbackId);
            };
        }
    }

    function submitFeedback(feedbackId) {
        const contentField = document.getElementById(`content-${feedbackId}`);
        const updatedContent = contentField.value;

        fetch(`<?php echo URLROOT; ?>/parents/updateFeedback/${feedbackId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ content: updatedContent })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Disable Editing
                contentField.setAttribute('readonly', true);

                // Reset Button
                const updateButton = document.getElementById(`update-btn-${feedbackId}`);
                updateButton.innerText = 'Update';
                updateButton.classList.remove('colorful-submit');
                updateButton.classList.add('btn-warning');

                // Reset Button Functionality
                updateButton.onclick = function () {
                    enableEditing(feedbackId);
                };
            } else {
                alert('Failed to update feedback.');
            }
        })
       
    }
</script>

<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>