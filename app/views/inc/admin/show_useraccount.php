<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User Accounts</title>

    <!-- Link to the CSS file -->

    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/insert_actor_style.css">

    <style>
        
    </style>
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
                        <th>User Reg</th>
                        <th>Full Name</th>
                        <th>Name With Initial</th>
                        <th>Email</th>
                        <th>Mobile No</th>
                        <th>Address</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Religion</th>
                        <th>Role</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user->regNo); ?></td>
                            <td><?php echo htmlspecialchars($user->fullName); ?></td>
                            <td><?php echo htmlspecialchars($user->nameWithInitial); ?></td>
                            <td><?php echo htmlspecialchars($user->email); ?></td>
                            <td><?php echo htmlspecialchars($user->mobileNo); ?></td>
                            <td><?php echo htmlspecialchars($user->address); ?></td>
                            <td><?php echo htmlspecialchars($user->dob); ?></td>
                            <td><?php echo htmlspecialchars($user->gender); ?></td>
                            <td><?php echo htmlspecialchars($user->religion); ?></td>
                            <td><?php echo htmlspecialchars($user->role); ?></td>
                            <td>
                                <a href="<?php echo URLROOT; ?>/Admin/editUser/<?php echo $user->regNo; ?>" class="btn btn-edit">Update</a><br><br>
                                <a href="<?php echo URLROOT; ?>/Admin/deleteUser/<?php echo $user->regNo; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this record?');">Delete </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- End of container -->
    </div> <!-- End of layout -->
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
