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
            <h1>Show Class Details</h1>

            <!-- Activities table -->
            <table class="activities-table">
                <thead>
                    <tr>
                    
                        <th>className</th>
                        <th>classTeacherId</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['classes'] as $classe): ?>
                        <tr>
                            <td><?php echo $classe->classId; ?></td>
                            <td><?php echo $classe->classTeacherId; ?></td>

                            <td>
                                <a href="<?php echo URLROOT; ?>/Admin/editClass/<?php echo $classe->classId; ?>" class="btn btn-edit">Edit</a><br></br>
                                <a href="<?php echo URLROOT; ?>/Admin/deleteClass/<?php echo $classe->classId; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this recode?');">Delete</a>
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