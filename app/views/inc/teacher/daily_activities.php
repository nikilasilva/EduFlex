<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
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
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="record-container">
        <h1>Record Activity</h1>

        <!-- Daily Activities form -->
        <form action="<?php echo URLROOT; ?>/teacher/submitActivities" method="POST">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" required>
            </div>

            <div class="form-group">
                <label for="period">Period:</label>
                <select name="period" id="period" required>
                    <option value="">Select Period</option>
                    <option value="1">Period 1</option>
                    <option value="2">Period 2</option>
                    <option value="3">Period 3</option>
                    <option value="4">Period 4</option>
                    <option value="5">Period 5</option>
                    <option value="6">Period 6</option>
                    <option value="7">Period 7</option>
                    <option value="8">Period 8</option>
                </select>
            </div>

            <div class="form-group">
                <label for="subject">Subject:</label>
                <select name="subject" id="subject" class="searchable" required>
                    <option value="">Search or Select a Subject</option>
                    <!-- Example subjects, replace these with dynamic options if needed -->
                    <option value="Mathematics">Mathematics</option>
                    <option value="Science">Science</option>
                    <option value="History">History</option>
                    <option value="English">English</option>
                    <option value="Buddhism">Buddhism</option>
                    <option value="Sinhala">Sinhala</option>
                    <option value="Tamil">Tamil</option>
                    <option value="PTS">Practical and technical skills</option>
                    <option value="Commerce">Commerce</option>
                    <option value="Art">Art</option>
                    <option value="Music">Music</option>
                    <option value="ICT">ICT</option>
                    <option value="Dancing">Dancing</option>
                </select>
            </div>

            <div class="form-group">
                <label for="class">Class:</label>
                <select name="class" id="class" class="searchable" required>
                    <option value="">Search or Select a Class</option>
                    
                    <option value="6A">6A</option>
                    <option value="7A">7A</option>
                    <option value="8A">8A</option>
                    <option value="9A">9A</option>
                    <option value="10A">10A</option>
                    <option value="11A">11A</option>

                    <option value="6B">6B</option>
                    <option value="7B">7B</option>
                    <option value="8B">8B</option>
                    <option value="9B">9B</option>
                    <option value="10B">10B</option>
                    <option value="11B">11B</option>

                    <option value="6C">6C</option>
                    <option value="7C">7C</option>
                    <option value="8C">8C</option>
                    <option value="9C">9C</option>
                    <option value="10C">10C</option>
                    <option value="11C">11C</option>

                    <option value="6D">6D</option>
                    <option value="7D">7D</option>
                    <option value="8D">8D</option>
                    <option value="9D">9D</option>
                    <option value="10D">10D</option>
                    <option value="11D">11D</option>
                </select>
                </select>
                </select>
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
    // Initialize Select2 for searchable dropdown
    $(document).ready(function() {
        $('.searchable').select2({
            placeholder: "Search or Select a Subject",
            allowClear: true
        });
    });
</script>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>


