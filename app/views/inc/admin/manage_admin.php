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
        <h1>Insert Admin Details</h1>

        <!-- Parent details form -->
        <form action="<?php echo URLROOT; ?>/Admin/submitadmin" method="POST">

            <div class="form-group">
                <label for="regNo">User Reg (Admin):</label>
                <input type="number" name="regNo" id="regNo" required>
                <small class="form-text">This should match an existing user in the Users table.</small>
            </div>

            <div class="form-group">
                <label for="NIC">NIC :</label>
                <input type="text" name="NIC" id="NIC" required>
            </div>


            <div class="form-group">
                <label for="firstName">First Name :</label>
                <input type="text" name="firstName" id="firstName" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name :</label>
                <input type="text" name="lastName" id="lastName" required>
            </div>

    

            <button type="submit" class="btn btn-primary">Submit Admin</button><br><br>

            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/Admin/viewAdmin'" class="btn btn-primary">View All Admin</button><br><br>

            <a href="<?php echo URLROOT; ?>/Admin/dashboard" class="btn btn-secondary">Cancel</a>


             <!-- ################To get users ID ################ -->

        
                 <h1>Show User Accounts</h1>

                <!-- User Accounts Table -->
                <table class="activities-table">
                    <thead>
                        <tr>
                            <th>User Reg</th>
                            
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['users'] as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user->regNo); ?></td>
                               
                                <td><?php echo htmlspecialchars($user->username); ?></td>
                                <td><?php echo htmlspecialchars($user->email); ?></td>

                                <td><?php echo htmlspecialchars($user->role); ?></td>

                            </tr>
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
