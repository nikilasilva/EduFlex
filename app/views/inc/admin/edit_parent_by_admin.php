<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Parent Details</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Update Parent Details</h1>

            <form action="<?php echo URLROOT; ?>/Admin/editParent/<?php echo $data['parents']->parentId; ?>" method="POST">

                <div class="form-group">
                    <label for="parentId">Parent ID:</label>
                    <textarea name="parentId" id="parentId" rows="1" readonly><?php echo htmlspecialchars($data['parents']->parentId); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="occupation">Occupation:</label>
                    <textarea name="occupation" id="occupation" rows="1" required><?php echo htmlspecialchars($data['parents']->occupation); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
                <a href="<?php echo URLROOT; ?>/Admin/viewParents" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
