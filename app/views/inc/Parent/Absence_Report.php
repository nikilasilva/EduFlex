<link rel = "stylesheet" href = "<?php echo URLROOT; ?>/public/css/feedbackStyles.css">

<div class = "submit-absences">
    <!-- <h2 class = "title">Report Absences</h2> -->
    <form method = "POST" action = "<?php echo URLROOT; ?>/parents/submitAbsence">

    <label for="student_id">Student ID:</label>
    <input type="text" id="student_id" name="student_id" required><br><br>
    

    <!-- Absence Content -->
    <label for="content"> Reason for Absence:</label><br>
    <textarea id = "content" name = "content" required placeholder = "Add Absence Report"></textarea>

        <button type = "submit" class = "btn btn-success colorful-submit">Submit </button>
    </form>

    <div class="view-feedbacks">
        <button class="btn btn-primary" onclick="window.location.href='<?php echo URLROOT; ?>/parents/viewAbsences';">
            View Absence Records
        </button>
        <!-- <button class="btn btn-primary" onclick="window.location.href='<?php echo URLROOT; ?>/parents/viewFeedbacks';">
            Update Feedbacks
        </button>
        <button class="btn btn-primary" onclick="window.location.href='<?php echo URLROOT; ?>/parents/viewFeedbacks';">
            Delete Feedbacks
        </button> -->
    </div>
</div>




