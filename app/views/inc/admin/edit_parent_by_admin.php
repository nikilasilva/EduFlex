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
                    <label for="fullName">Full Name:</label>
                    <input type="text" name="fullName" id="fullName" value="<?php echo htmlspecialchars($data['parents']->fullName); ?>" required>
                </div>

                <div class="form-group">
                    <label for="nameWithInitial">Name with Initials:</label>
                    <input type="text" name="nameWithInitial" id="nameWithInitial" value="<?php echo htmlspecialchars($data['parents']->nameWithInitial); ?>" required>
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
                    <label for="Relationship">Relationship :</label>
                    <select name="Relationship" id="Relationship" required>
                        <option value="">-- Select Relationship --</option>
                        <option value="Mother" <?php echo ($data['parents']->Relationship === 'Mother') ? 'selected' : ''; ?>>Mother</option>
                        <option value="Father" <?php echo ($data['parents']->Relationship === 'Father') ? 'selected' : ''; ?>>Father</option>
                        <option value="Guardian" <?php echo ($data['parents']->Relationship === 'Guardian') ? 'selected' : ''; ?>>Guardian</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
                <a href="<?php echo URLROOT; ?>/Admin/viewParents" class="btn btn-secondary">Back to List</a>
            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
