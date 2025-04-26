<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Class Details</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
     <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/insert_actor_style.css">
</head>

<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Insert Class Details</h1>

                <form action="<?php echo URLROOT; ?>/Admin/submitClass" method="POST">
                    <!-- Class Name Input -->
                

                    <!-- Class Teacher ID Input -->
                    <div class="form-group">
                        <label for="className">Class Name:</label>
                        <input type="text" name="className" id="className" required>
                    </div>
                    <div class="form-group">
                        <label for="academicYear">Academic Year:</label>
                        <input type="text" name="academicYear" id="academicYear" required>
                    </div>

                    <!-- Buttons -->
                    <button type="submit" class="btn btn-primary">Submit Class</button><br><br>
                    <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewClass'" class="btn btn-primary">View Class</button><br><br>
                    <a href="<?php echo URLROOT; ?>/Dashboard/index" class="btn btn-secondary">Cancel</a>



                </form>
        </div>
</div>
</body>
</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
