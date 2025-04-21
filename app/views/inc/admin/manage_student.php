<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Insert Student Details</h1>

        <!-- Student Form -->
        <form action="<?php echo URLROOT; ?>/Admin/submitStudent" method="POST">

            <!-- User ID -->
            <div class="form-group">
                <label for="regNo">User Reg:</label>
                <input type="number" name="regNo" id="regNo" required>
            </div>

            <!-- First Name -->
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" id="firstName" required>
            </div>

            <!-- Last Name -->
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" id="lastName" required>
            </div>

            <!-- Class ID -->
            <div class="form-group">
                <label for="classId">Class name:</label>
                <input type="text" name="classId" id="classId" required>
            </div>

            <!-- Guardian (Parent) User ID (Optional) -->
            <div class="form-group">
                <label for="guardianUserID">Guardian (Parent) User ID (optional):</label>
                <input type="number" name="guardianUserID" id="guardianUserID">
            </div>

            <!-- Buttons -->
            <button type="submit" class="btn btn-primary">Submit Student</button><br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewStudent'" class="btn btn-primary">View All Records</button><br><br>
            <a href="<?php echo URLROOT; ?>/admin/dashboard" class="btn btn-secondary">Cancel</a>



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

<?php require APPROOT.'/views/inc/footer.php'; ?>
