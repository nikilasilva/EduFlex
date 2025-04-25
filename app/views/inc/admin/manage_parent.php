<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Parent</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Insert Parent Details</h1>

        <!-- Parent details form -->
        <form action="<?php echo URLROOT; ?>/Admin/submitParent" method="POST">

            <div class="form-group">
                <label for="regNo">User Reg (Parent):</label>
                <input type="number" name="regNo" id="regNo" required>
                <small class="form-text">This should match an existing user in the Users table.</small>
            </div>

            <div class="form-group">
                <label for="NIC">NIC :</label>
                <input type="text" name="NIC" id="NIC" required>
            </div>


            <div class="form-group">
                <label for="Relationship">Relationship:</label>
                <select name="Relationship" id="Relationship" required>
                    <option value="">-- Select Relationship --</option>
                    <option value="Mother">Mother</option>
                    <option value="Father">Father</option>
                    <option value="Guardian">Guardian</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Submit Parent</button><br><br>

            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/Admin/viewParent'" class="btn btn-primary">View All Parents</button><br><br>

            <!-- <a href="<?php echo URLROOT; ?>/Admin/dashboard" class="btn btn-secondary">Cancel</a> -->


             <!-- ################To get users ID ################ -->

        
             <h1>Show Parent Accounts</h1>

            <!-- Student Accounts Table -->
            <table class="activities-table">
                <thead>
                    <tr>
                        <th>Reg No</th>
                        <th>Name with Initials</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $user): ?>
                        <?php if ($user->role === 'parent'): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user->regNo); ?></td>
                                <td><?php echo htmlspecialchars($user->nameWithInitial); ?></td>
                                <td><?php echo htmlspecialchars($user->email); ?></td>
                                <td><?php echo htmlspecialchars($user->role); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>




                <!-- ################To get users ID ################ -->

        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
