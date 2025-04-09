<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Parent Details</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Show Parent Details</h1>

            <!-- Parent details table -->
            <table class="activities-table">
                <thead>
                    <tr>
                        <th>Parent ID</th>
                        <th>Occupation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['parents'] as $parent): ?>
                        <tr>
                            <td><?php echo $parent->parentId; ?></td>
                        
                            <td><?php echo $parent->occupation; ?></td>
                            <td>
                                <a href="<?php echo URLROOT; ?>/Admin/editParent/<?php echo $parent->parentId; ?>" class="btn btn-edit">Edit</a><br><br>
                                <a href="<?php echo URLROOT; ?>/Admin/deleteParent/<?php echo $parent->parentId; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
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
