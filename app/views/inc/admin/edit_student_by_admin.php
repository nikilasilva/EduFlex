<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>

<body>
    <div class="layout">
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <div class="container">
            <h1>Update Student Details</h1>

            <form action="<?php echo URLROOT; ?>/Admin/editStudent/<?php echo $data['student']->studentId; ?>" method="POST">
                
                <div class="form-group">
                    <label for="userID">User ID :</label>
                    <input type="text" name="userID" id="userID" required value="<?php echo htmlspecialchars($data['student']->userID); ?>">
                </div>

                <div class="form-group">
                    <label for="firstName">First Name :</label>
                    <input type="text" name="firstName" id="firstName" required value="<?php echo htmlspecialchars($data['student']->firstName); ?>">
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name :</label>
                    <input type="text" name="lastName" id="lastName" required value="<?php echo htmlspecialchars($data['student']->lastName); ?>">
                </div>

                <div class="form-group">
                    <label for="classId">Class ID :</label>
                    <input type="text" name="classId" id="classId" required value="<?php echo htmlspecialchars($data['student']->classId); ?>">
                </div>

                <div class="form-group">
                    <label for="guardianUserID">Guardian User ID :</label>
                    <input type="text" name="guardianUserID" id="guardianUserID" value="<?php echo htmlspecialchars($data['student']->guardianUserID); ?>">
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
                <a href="<?php echo URLROOT; ?>/Admin/viewStudent" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
