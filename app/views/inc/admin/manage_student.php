<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Insert Student Details</h1>

        <!-- Student Form -->
        <form action="<?php echo URLROOT; ?>/Admin/submitStudent" method="POST">

            <!-- User ID -->
            <div class="form-group">
                <label for="userID">User ID:</label>
                <input type="number" name="userID" id="userID" required>
            </div>

            <!-- First Name -->
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" id="firstName" required>
            </div>

            <!-- Last Name -->
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" id="lastName" required>
            </div>

            <!-- Class ID -->
            <div class="form-group">
                <label for="classId">Class ID:</label>
                <input type="number" name="classId" id="classId" required>
            </div>

            <!-- Guardian (Parent) User ID (Optional) -->
            <div class="form-group">
                <label for="guardianUserID">Guardian (Parent) User ID (optional):</label>
                <input type="number" name="guardianUserID" id="guardianUserID">
            </div>

            <!-- Buttons -->
            <button type="submit" class="btn btn-primary">Submit Student</button><br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewStudent'" class="btn btn-primary">View All Records</button><br><br>
            <a href="<?php echo URLROOT; ?>/admin/dashboard" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
