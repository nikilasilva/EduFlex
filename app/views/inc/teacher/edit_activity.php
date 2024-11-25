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
</head>
<body>
<div class="layout">
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <div class="record-container">
        <h1>Edit Activity</h1>

        <form action="<?php echo URLROOT; ?>/teacher/editActivity/<?php echo $data['activity']->activity_id; ?>" method="POST">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($data['activity']->date); ?>" required>
            </div>

            <div class="form-group">
                
                <label for="time_from">from</label>
                <input type="time" name="time_from" id="time_from" value="<?php echo htmlspecialchars($data['activity']->time_from); ?>" required>
                
            </div>

            <div class="form-group">
                
                <label for="time_to">to</label>
                <input type="time" name="time_to" id="time_to" value="<?php echo htmlspecialchars($data['activity']->time_to); ?>" required>
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <textarea name="subject" id="subject" required><?php echo htmlspecialchars($data['activity']->subject); ?></textarea>
            </div>

            <div class="form-group">
                <label for="clas">Class</label>
                <textarea name="class" id="class" required><?php echo htmlspecialchars($data['activity']->class); ?></textarea>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" required><?php echo htmlspecialchars($data['activity']->description); ?></textarea>
            </div>

            <div class="form-group">
                <label for="additional_note">Additional Note</label>
                <textarea name="additional_note" id="additional_note"><?php echo htmlspecialchars($data['activity']->additional_note); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button><br></br>
            <a href="<?php echo URLROOT; ?>/teacher/viewActivities" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>

