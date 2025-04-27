<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Activity</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/teacher.css">
teacher
<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Show Teacher Details</h1>

            <!-- Activities table -->
            <table class="activities-table">
                <thead>
                    <tr>
                        
                        <th>User Reg</th>
                        <th>Teacher ID</th>
                        <th>Name With Initials</th>
                        <th>Subject</th>
                        <th>Year of Experience</th>
                        <th>Hire Date</th>
                        <th>Operation</th>
                        

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['teachers'] as $teacher): ?>
                        <tr>
                            
                            <td><?php echo $teacher->regNo; ?></td>
                            <td><?php echo $teacher->teacher_id; ?></td>
                            <td><?php echo $teacher->nameWithInitial?></td>
                            <td><?php echo $teacher->subject; ?></td>
                            <td><?php echo $teacher->experience; ?></td>
                            <td><?php echo $teacher->hireDate; ?></td>

                            <td>
                                <a href="<?php echo URLROOT; ?>/Admin/editTeacher/<?php echo $teacher->teacher_id; ?>" class="btn btn-edit">Update</a>
                                <a href="<?php echo URLROOT; ?>/Admin/deleteTeacher/<?php echo $teacher->teacher_id; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this recode?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>