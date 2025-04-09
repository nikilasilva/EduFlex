<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User Accounts</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/admin.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Show User Accounts</h1>

            <!-- User Accounts Table -->
            <table class="activities-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Mobile No</th>
                        <th>Address</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Religion</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user->userID); ?></td>
                            <td><?php echo htmlspecialchars($user->firstName); ?></td>
                            <td><?php echo htmlspecialchars($user->lastName); ?></td>
                            <td><?php echo htmlspecialchars($user->username); ?></td>
                            <td><?php echo htmlspecialchars($user->email); ?></td>
                            <td><?php echo htmlspecialchars($user->mobileNo); ?></td>
                            <td><?php echo htmlspecialchars($user->address); ?></td>
                            <td><?php echo htmlspecialchars($user->dob); ?></td>
                            <td><?php echo htmlspecialchars($user->gender); ?></td>
                            <td><?php echo htmlspecialchars($user->religion); ?></td>
                            <td><?php echo htmlspecialchars($user->role); ?></td>
                            <td>
                                <a href="<?php echo URLROOT; ?>/Admin/editUser/<?php echo $user->userID; ?>" class="btn btn-edit">Edit</a><br><br>
                                <a href="<?php echo URLROOT; ?>/Admin/deleteUser/<?php echo $user->userID; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
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
