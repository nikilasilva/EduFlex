<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Activity</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">

    <!-- Add Select2 CSS for searchable dropdown -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
</head>
<body>
<div class="layout">
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <div class="record-container">
        <h1>Update Activity</h1>

        <form action="<?php echo URLROOT; ?>/teacher/editActivity/<?php echo $data['activity']->activity_id; ?>" method="POST">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($data['activity']->date); ?>" required>
            </div>

            <div class="form-group">
                <label for="period">Period:</label>
                <select name="period" id="period" class="searchable" required>
                    <option value="">Search or Select a Period</option>
                    <?php 
                    // Dynamically select the current value
                    $periods = ["1", "2", "3", "4", "5", "6", "7", "8"];
                    foreach ($periods as $period) {
                        $selected = ($data['activity']->period == $period) ? "selected" : "";
                        echo "<option value='$period' $selected>Period $period</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="subject">Subject:</label>
                <textarea name="subject" id="subject" rows="1" required><?php echo htmlspecialchars($data['activity']->subject); ?></textarea>
            </div>

            <div class="form-group">
                <label for="subject">Subject:</label>
                <select name="subject" id="subject" class="searchable" required>
                    <option value="">Search or Select a Subject</option>
                    <?php 
                    
                    $subjects = ["Mathematics", "Science", "History", "English", "Buddhism", "Sinhala", "Tamil", "Practical and technical skills", "Commerce", "Art", "Music", "ICT","Dancing"];
                    foreach ($subjects as $subject) {
                        $selected = ($data['activity']->subject == $subject) ? "selected" : "";
                        echo "<option value='$subject' $selected>$subject</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="class">Class:</label>
                <select name="class" id="class" class="searchable" required>
                    <option value="">Search or Select a Class</option>
                    <?php 
                    // Example classes, replace these with dynamic options if needed
                    $classes = ["6A", "7A", "8A", "9A", "10A","11A","6B", "7B", "8B", "9B", "10B","11B","6C", "7C", "8C", "9C", "10C","11C","6D", "7D", "8D", "9D", "10D","11D"];
                    foreach ($classes as $class) {
                        $selected = ($data['activity']->class == $class) ? "selected" : "";
                        echo "<option value='$class' $selected>$class</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="4" required><?php echo htmlspecialchars($data['activity']->description); ?></textarea>
            </div>

            <div class="form-group">
                <label for="additional_note">Additional Note:</label>
                <textarea name="additional_note" id="additional_note" rows="4"><?php echo htmlspecialchars($data['activity']->additional_note); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
            <a href="<?php echo URLROOT; ?>/teacher/viewActivities" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<!-- Include Select2 JS for searchable dropdown -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    // Initialize Select2 for searchable dropdowns
    $(document).ready(function() {
        $('.searchable').select2({
            placeholder: "Search or Select",
            allowClear: true
        });
    });
</script>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>

