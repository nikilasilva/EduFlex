
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/feedbackStyles.css">

<div class="submit-feedback">
    
    
    <!-- Feedback Submission Form -->
    <form method="POST" action="<?php echo URLROOT; ?>/parents/submitFeedback">
    <div class="form-group-feedback">
        <!-- <label for="recipient" class="label-feedback">Select Recipient</label> -->
        <select id="recipient" name="recipient" required class="form-control-feedback">
            <option value="">Choose Recipient</option>
            <!-- <option value="teacher">Teacher</option>  -->
            <option value="principal">Principal</option>
            <!-- <option value="both">Both</option> -->
        </select>
    </div>



        <textarea id="content" name="content" required placeholder="Add Your Feedback"></textarea>
        
        <button type="submit" class="btn btn-success colorful-submit">Submit Feedback</button>
    </form>

    <!-- View Feedbacks Button -->
    <div class="view-feedbacks">
        <button class="btn btn-primary" onclick="window.location.href='<?php echo URLROOT; ?>/parents/viewFeedbacks';">
            View Feedbacks
        </button>
        <!-- <button class="btn btn-primary" onclick="window.location.href='<?php echo URLROOT; ?>/parents/viewFeedbacks';">
            Update Feedbacks
        </button>
        <button class="btn btn-primary" onclick="window.location.href='<?php echo URLROOT; ?>/parents/viewFeedbacks';">
            Delete Feedbacks
        </button> -->
    </div>
</div>


