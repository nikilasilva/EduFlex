<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Parent</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Insert Parent Details</h1>

        <!-- Parent details form -->
        <form action="<?php echo URLROOT; ?>/Admin/submitParent" method="POST">

            <div class="form-group">
                <label for="userID">User ID (Parent):</label>
                <input type="number" name="userID" id="userID" required>
                <small class="form-text">This should match an existing user in the Users table.</small>
            </div>

            <div class="form-group">
                <label for="occupation">Occupation:</label>
                <input type="text" name="occupation" id="occupation" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit Parent</button><br><br>

            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/Admin/viewParent'" class="btn btn-primary">View All Parents</button><br><br>

            <a href="<?php echo URLROOT; ?>/Admin/dashboard" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
