<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Non-Academic Staff</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/teacher.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Show Non-Academic Staff Details</h1>

            <!-- Staff table -->
            <table class="activities-table">
                <thead>
                    <tr>
                        <th>Staff ID</th>
                        <th>User ID</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Hire Date</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['nonacas'] as $nonaca): ?>
                        <tr>
                            <td><?php echo $nonaca->staffId; ?></td>
                            <td><?php echo $nonaca->userID; ?></td>
                            <td><?php echo $nonaca->position; ?></td>
                            <td><?php echo $nonaca->department; ?></td>
                            <td><?php echo $nonaca->hireDate; ?></td>
                            <td>
                                <a href="<?php echo URLROOT; ?>/Admin/editNonaca/<?php echo $nonaca->staffId; ?>" class="btn btn-edit">Edit</a><br><br>
                                <a href="<?php echo URLROOT; ?>/Admin/deleteNonaca/<?php echo $nonaca->staffId; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
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
