<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Non-Academic Staff</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/style.css">
</head>

<body>
    <div class="layout">
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>
        <div class="container">
            <h1>Edit Non-Academic Staff Details</h1>

            <form action="<?php echo URLROOT; ?>/Admin/editNonaca/<?php echo $data['nonaca']->staffId; ?>" method="POST">

                <!-- User ID (read-only for safety) -->
                <div class="form-group">
                    <label for="userID">User ID:</label>
                    <input type="number" name="userID" id="userID" value="<?php echo $data['nonaca']->userID; ?>" readonly>
                </div>

                <!-- Position -->
                <div class="form-group">
                    <label for="position">Position:</label>
                    <input type="text" name="position" id="position" value="<?php echo $data['nonaca']->position; ?>" required>
                </div>

                <!-- Department -->
                <div class="form-group">
                    <label for="department">Department:</label>
                    <input type="text" name="department" id="department" value="<?php echo $data['nonaca']->department; ?>" required>
                </div>

                <!-- Hire Date -->
                <div class="form-group">
                    <label for="hireDate">Hire Date:</label>
                    <input type="date" name="hireDate" id="hireDate" value="<?php echo $data['nonaca']->hireDate; ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Details</button>
                <br><br>
                <a href="<?php echo URLROOT; ?>/Admin/viewNonaca" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
