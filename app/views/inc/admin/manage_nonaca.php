<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Non-Academic Staff</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Insert Non-Academic Staff Details</h1>

        <form action="<?php echo URLROOT; ?>/Admin/submitNonaca" method="POST">
            
            <!-- User ID -->
            <div class="form-group">
                <label for="userID">User ID:</label>
                <input type="number" name="userID" id="userID" required>
            </div>

            <!-- Position -->
            <div class="form-group">
                <label for="position">Position:</label>
                <input type="text" name="position" id="position" required>
            </div>

            <!-- Department -->
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" name="department" id="department" required>
            </div>

            <!-- Hire Date -->
            <div class="form-group">
                <label for="hireDate">Hire Date:</label>
                <input type="date" name="hireDate" id="hireDate" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit Non-Academic</button><br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewNonaca'" class="btn btn-primary">View Non-Academic Staff</button><br><br>
            <a href="<?php echo URLROOT; ?>/teacher/viewActivities" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
