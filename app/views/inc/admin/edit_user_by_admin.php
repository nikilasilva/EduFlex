<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Account</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Update User Account</h1>

            <!-- User Account Edit Form -->
            <form action="<?php echo URLROOT; ?>/Admin/editUser/<?php echo $data['user']->userID; ?>" method="POST">

                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <textarea name="firstName" id="firstName" rows="1" required><?php echo htmlspecialchars($data['user']->firstName); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <textarea name="lastName" id="lastName" rows="1" required><?php echo htmlspecialchars($data['user']->lastName); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <textarea name="username" id="username" rows="1" required><?php echo htmlspecialchars($data['user']->username); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <textarea name="email" id="email" rows="1" required><?php echo htmlspecialchars($data['user']->email); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="mobileNo">Mobile Number:</label>
                    <textarea name="mobileNo" id="mobileNo" rows="1" required><?php echo htmlspecialchars($data['user']->mobileNo); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea name="address" id="address" rows="2" required><?php echo htmlspecialchars($data['user']->address); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($data['user']->dob); ?>" required>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender" required>
                        <option value="Male" <?php if ($data['user']->gender == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if ($data['user']->gender == 'Female') echo 'selected'; ?>>Female</option>
                        <option value="Other" <?php if ($data['user']->gender == 'Other') echo 'selected'; ?>>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="religion">Religion:</label>
                    <textarea name="religion" id="religion" rows="1" required><?php echo htmlspecialchars($data['user']->religion); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" id="role" required>
                        <option value="admin" <?php if ($data['user']->role == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="teacher" <?php if ($data['user']->role == 'teacher') echo 'selected'; ?>>Teacher</option>
                        <option value="student" <?php if ($data['user']->role == 'student') echo 'selected'; ?>>Student</option>
                        <option value="principal" <?php if ($data['user']->role == 'principal') echo 'selected'; ?>>Principal</option>
                        <option value="vice-principal" <?php if ($data['user']->role == 'vice-principal') echo 'selected'; ?>>Vice Principal</option>
                        <option value="non-academic" <?php if ($data['user']->role == 'non-academic') echo 'selected'; ?>>Non-academic</option>
                        <option value="parent" <?php if ($data['user']->role == 'parent') echo 'selected'; ?>>Parent</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="password">Password (Leave blank to keep current):</label>
                    <textarea name="password" id="password" rows="1"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
                <a href="<?php echo URLROOT; ?>/Admin/viewUser" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
