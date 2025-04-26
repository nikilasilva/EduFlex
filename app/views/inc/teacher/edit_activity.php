<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
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
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

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
                    <select name="subject" id="subject" class="searchable" required>
                        <option value="">Search or Select a Subject</option>
                        <?php foreach ($data['subjects'] as $subject): ?>
                            <?php $selected = ($data['activity']->subject == $subject->subjectName) ? "selected" : ""; ?>
                            <option value="<?= htmlspecialchars($subject->subjectName) ?>" <?= $selected ?>>
                                <?= htmlspecialchars($subject->subjectName) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <div class="form-group">
                    <label for="class">Class:</label>
                    <select name="class" id="class" class="searchable" required>
                        <option value="">Search or Select a Class</option>
                        <?php foreach ($data['classes'] as $class): ?>
                            <?php
                            $selected = '';
                            if (trim($data['activity']->class) == trim($class->className)) {
                                $selected = 'selected';
                            }
                            ?>
                            <option value="<?= htmlspecialchars($class->className) ?>" <?= $selected ?>>
                                <?= htmlspecialchars($class->className) ?>
                            </option>
                        <?php endforeach; ?>
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

<?php require APPROOT . '/views/inc/footer.php'; ?>