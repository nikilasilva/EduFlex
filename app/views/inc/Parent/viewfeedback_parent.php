<?php
session_start();

// Include header and top navigation bar
require APPROOT . '/views/inc/header.php'; 
require APPROOT . '/views/inc/components/topNavbar.php'; 
?>

<!-- Link to external CSS for styling -->
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/feedbackStyles.css">

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Feedback Display Container -->
<div class="feedback-set-container">
    <h1>Parents Feedbacks</h1>

    <!-- Check if there are feedbacks to display -->
    <?php if (!empty($data['feedbacks']) && is_array($data['feedbacks']) && count($data['feedbacks']) > 0): ?>
        <?php foreach ($data['feedbacks'] as $feedback): ?>
            <div class="feedback-card" id="feedback-<?php echo $feedback->feedback_id; ?>">
                <!-- Display Feedback Content -->
                <textarea 
                    class="feedback-content fixed-space" 
                    id="content-<?php echo $feedback->feedback_id; ?>" 
                    readonly
                ><?php echo htmlspecialchars($feedback->content); ?></textarea>

                <!-- Display Feedback Date -->
                <div class="feedback-date"><?php echo $feedback->date; ?></div>

                <!-- Action Buttons: Update and Delete -->
                <div class="feedback-actions">
                    <!-- Update Button -->
                    <button 
                        id="update-btn-<?php echo $feedback->feedback_id; ?>" 
                        class="btn btn-warning <?php echo $feedback->is_read ? 'disabled' : ''; ?>"
                        onclick="<?php echo $feedback->is_read ? '' : "enableEditing({$feedback->feedback_id});"; ?>"
                        <?php echo $feedback->is_read ? 'disabled' : ''; ?>
                    >
                        Update
                    </button>

                    <!-- Delete Button -->
                    <button 
                        class="btn btn-danger <?php echo $feedback->is_read ? 'disabled' : ''; ?>"
                        onclick="<?php echo $feedback->is_read ? '' : "showDeletePopup({$feedback->feedback_id});"; ?>"
                        <?php echo $feedback->is_read ? 'disabled' : ''; ?>
                    >
                        Delete
                </div>



                <!-- Read Status Indicator -->
                <?php if ($feedback->is_read): ?>
                    <div class="read-status">
                        <span class="badge badge-info">Read by Principal</span>
                    </div>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Message if no feedbacks are available -->
        <p>No feedbacks available.</p>
    <?php endif; ?>
</div>

<!-- JavaScript for Feedback Actions -->
<script>
    // Function to enable editing feedback
    function enableEditing(feedbackId) {
        const contentField = document.getElementById(`content-${feedbackId}`);
        const updateButton = document.getElementById(`update-btn-${feedbackId}`);

        if (updateButton.innerText === 'Update') {
            // Enable editing
            contentField.removeAttribute('readonly');
            contentField.focus();

            // Change button to submit
            updateButton.innerText = 'Submit';
            updateButton.classList.remove('btn-warning');
            updateButton.classList.add('btn-success');

            // Update button functionality to submit updated feedback
            updateButton.onclick = function () {
                submitFeedback(feedbackId);
            };
        }
    }

    // Function to submit updated feedback
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
                // Disable editing after successful update
                contentField.setAttribute('readonly', true);

                // Reset update button
                const updateButton = document.getElementById(`update-btn-${feedbackId}`);
                updateButton.innerText = 'Update';
                updateButton.classList.remove('btn-success');
                updateButton.classList.add('btn-warning');

                // Reset button functionality
                updateButton.onclick = function () {
                    enableEditing(feedbackId);
                };
            } else {
                alert('Failed to update feedback.');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Function to confirm deletion of feedback
    function showDeletePopup(feedbackId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete the feedback
                window.location.href = `<?php echo URLROOT; ?>/parents/deleteFeedback/${feedbackId}`;
            }
        });
    }
</script>

<!-- Include sidebar and footer -->
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
