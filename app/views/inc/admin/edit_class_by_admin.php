<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class Details</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/style.css">
</head>

<body>
    <div class="layout">
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>
        <div class="container">
            <h1>Edit Class Details</h1>

            <form action="<?php echo URLROOT; ?>/Admin/editClass/<?php echo $data['class']->classId; ?>" method="POST">

                <!-- Class ID (read-only) -->
                <div class="form-group">
                    <label for="classId">Class ID:</label>
                    <input type="number" name="classId" id="classId" value="<?php echo $data['class']->classId; ?>" readonly>
                </div>

                <!-- Class Name -->
                <div class="form-group">
                    <label for="classId">Class Name:</label>
                    <input type="text" name="classId" id="classId" value="<?php echo $data['class']->classId; ?>" required>
                </div>

                <!-- Class Teacher ID -->
                <div class="form-group">
                    <label for="classTeacherId">Class Teacher ID:</label>
                    <input type="number" name="classTeacherId" id="classTeacherId" value="<?php echo $data['class']->classTeacherId; ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Class</button>
                <br><br>
                <a href="<?php echo URLROOT; ?>/Admin/viewClass" class="btn btn-secondary">Back to Class List</a>
            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
