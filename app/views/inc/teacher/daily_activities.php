<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Activity</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">

    <!-- Add Select2 CSS for searchable dropdown -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="record-container">
            <h1>Record Activity</h1>

            <!-- Alert messages -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <!-- Daily Activities form -->
            <form action="<?php echo URLROOT; ?>/teacher/submitActivities" method="POST">
                <div class="form-group">
                    <label for="absence_date">Date:</label>
                    <input
                        type="date"
                        id="attendance_date"
                        name="attendance_date"
                        max="<?= date('Y-m-d') ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="period">Period:</label>
                    <select name="period" id="period" required>
                        <option value="">Select Period</option>
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                            <option value="<?php echo $i; ?>">Period <?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <select name="subject" id="subject" class="searchable" required>
                        <option value="">Search or Select a Subject</option>
                        <?php foreach ($data['subjects'] as $subject): ?>
                            <option value="<?= $subject->subjectName ?>">
                                <?= $subject->subjectName ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>

                <div class="form-group">
                    <label for="class">Class:</label>
                    <select name="class" id="class" class="searchable" required>
                        <option value="">Search or Select a Class</option>
                        <?php foreach ($data['classes'] as $class): ?>
                            <option value="<?= $class->classId ?>">
                                <?= $class->className ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>


                <div class="form-group">
                    <label for="description">Name of the lesson / Nature of work done:</label>
                    <textarea name="description" id="description" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="additional_note">Additional Notes:</label>
                    <textarea name="additional_note" id="additional_note" rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Activity</button><br><br>
                <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/teacher/viewActivities'" class="btn btn-primary">View All Records</button><br><br>
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