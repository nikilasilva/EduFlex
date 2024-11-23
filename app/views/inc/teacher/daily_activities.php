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
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Record Activity</h1>

        <!-- Daily Activities form -->
        <form action="<?php echo URLROOT; ?>/teacher/submitActivities" method="POST">
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" required>
            </div>

            <div class="form-group">
                
                <label for="time_from">from</label> 
                <input type="time" name="time_from" id="time_from" required> 
                
            </div>

            <div class="form-group">
                
            
                <label for="time_to">to</label>
                <input type="time" name="time_to" id="time_to" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <textarea name="subject" id="subject" rows="1" required></textarea>
            </div>

            <div class="form-group">
                <label for="class">Class:</label>
                <textarea name="class" id="class" rows="1" required></textarea>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="additional_note">Additional Notes:</label>
                <textarea name="additional_note" id="additional_note" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Activity</button><br></br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/teacher/viewActivities'" class="btn btn-primary">View All Records</button><br></br>

            <a href="<?php echo URLROOT; ?>/teacher/viewActivities" class="btn btn-secondary">Cancel</a>

            
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>

