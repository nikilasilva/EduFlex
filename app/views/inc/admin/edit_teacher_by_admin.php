<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Books</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Update Teacher Details </h1>



            <!-- Daily Activities form -->
            <!-- <form action="<?php echo URLROOT; ?>/NonAcademic/editActivity" method="POST"> -->
            <form action="<?php echo URLROOT; ?>/Admin/editTeacher/<?php echo $data['teacher']->teacher_id; ?>" method="POST">


               




            <div class="form-group">
                <label for="teacher_id">Teacher ID :</label>
                <input type="number" name="teacher_id" id="teacher_id" value="<?php echo $data['teacher']->teacher_id; ?>" required>
            </div>

            <div class="form-group">
                    <label for="subject">subject:</label>
                    <input type="text" name="subject" id="subject" value="<?php echo $data['teacher']->subject; ?>" required>
            </div>

            <div class="form-group">
                    <label for="experience">Year of Experience:</label>
                    <input type="number" name="experience" id="experience" value="<?php echo $data['teacher']->experience; ?>" required>
            </div>

            <div class="form-group">
                    <label for="hireDate">Hire Date:</label>
                    <input type="date" name="hireDate" id="hireDate" value="<?php echo $data['teacher']->hireDate; ?>" required>
            </div>

            



            




                <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
                <a href="<?php echo URLROOT; ?>/Admin/viewTeacher" class="btn btn-secondary">Cancel</a>



            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>