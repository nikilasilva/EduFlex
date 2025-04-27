<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Backup Users</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/insert_actor_style.css">
</head>
<body>
    <div class="layout">
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <div class="container">
            <h1>Backup User Accounts</h1>

            <table class="activities-table">
                <thead>
                    <tr>
                        <th>Reg No</th>
                        <th>Full Name</th>
                        <th>Name With Initial</th>
                        <th>Email</th>
                        <th>Mobile No</th>
                        <th>Address</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Religion</th>
                        <th>Role</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['backupusers'] as $user): ?>
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
                        
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php require APPROOT . '/views/inc/footer.php'; ?>
