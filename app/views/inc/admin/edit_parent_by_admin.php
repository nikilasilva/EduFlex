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

            <form action="<?php echo URLROOT; ?>/Admin/editParent/<?php echo $data['parents']->regNo; ?>" method="POST">

                <div class="form-group">
                    <label for="regNo">User Reg (Parent):</label>
                    <input type="number" name="regNo" id="regNo" value="<?php echo htmlspecialchars($data['parents']->regNo); ?>" required>
                </div>


                <div class="form-group">
                    <label for="NIC">NIC (Parent):</label>
                    <input type="text" name="NIC" id="NIC" value="<?php echo htmlspecialchars($data['parents']->NIC); ?>" required>
                </div>

                <!-- <div class="form-group">
                    <label for="occupation">Occupation:</label>
                    <textarea name="occupation" id="occupation" rows="1" required><?php echo htmlspecialchars($data['parents']->occupation); ?></textarea>
                </div> -->

                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" id="firstName" value="<?php echo htmlspecialchars($data['parents']->firstName); ?>" required>
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" id="lastName" value="<?php echo htmlspecialchars($data['parents']->lastName); ?>" required>
                </div>

                <div class="form-group">
                    <label for="Relationship">Relationship :</label>
                    <input type="text" name="Relationship" id="Relationship" value="<?php echo htmlspecialchars($data['parents']->Relationship); ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
                <a href="<?php echo URLROOT; ?>/Admin/viewParents" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
