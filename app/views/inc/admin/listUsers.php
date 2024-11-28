<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>



<div class="all-user-list-container">
    <h1>List of Users</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Reg No</th>
                <th>Email</th>
                <th>Mobile No</th>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data)): ?>
                <?php foreach ($data['users'] as $index => $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user->regNo); ?></td>
                        <td><?php echo htmlspecialchars($user->email); ?></td>
                        <td><?php echo htmlspecialchars($user->mobileNo); ?></td>
                        <td><?php echo htmlspecialchars($user->username); ?></td>
                        <td><?php echo htmlspecialchars($user->role); ?></td>
                        <td>
                            <form action="<?php echo URLROOT; ?>/Admin/deleteUser/<?php echo $user->regNo; ?>" method="POST">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
