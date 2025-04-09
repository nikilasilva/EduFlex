<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Teacher Details</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Insert Teacher Details</h1>

        <form action="<?php echo URLROOT; ?>/Admin/submitTeacher" method="POST">
            
            <div class="form-group">
                <label for="userID">User ID:</label>
                <input type="number" name="userID" id="userID" required>
            </div>

            <div class="form-group">
                <label for="specialization">Specialization:</label>
                <textarea name="specialization" id="specialization" rows="1" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Teacher</button><br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewTeacher'" class="btn btn-primary">View Teachers</button><br><br>

            <a href="<?php echo URLROOT; ?>/admin/dashboard" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
