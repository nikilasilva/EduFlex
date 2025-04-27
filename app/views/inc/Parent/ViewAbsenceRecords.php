
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/components/view_feedback.css">


<!-- Feedback Display Container -->
<div class="feedback-set-container">
    <h1>Absences Records</h1>


    <!-- Check if there are feedbacks to display -->
    <?php if (!empty($data['absences']) && is_array($data['absences']) && count($data['absences']) > 0): ?>
        <?php foreach ($data['absences'] as $absences): ?>
            <div class="feedback-card" id="feedback-<?php echo $absences->absence_id; ?>">
                <!-- Display Feedback Content -->
                <div class="feedback-student-id">Student ID: <?php echo $absences->student_id; ?></div>
                <textarea 
                    class="feedback-content fixed-space" 
                    id="content-<?php echo $absences->absence_id; ?>" 
                    readonly
                ><?php echo htmlspecialchars($absences->content); ?>
                </textarea>

                <!-- Display Feedback Date -->
                <div class="feedback-date"><?php echo $absences->date; ?></div>
                

                
               

        </div>
                <?php endforeach; ?>
         
        <!-- Message if no feedbacks are available -->
        
    <?php endif; ?>
</div>

<!-- JavaScript for Feedback Actions -->
