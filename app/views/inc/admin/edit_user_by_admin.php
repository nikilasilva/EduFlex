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

        <?php if(!empty($data['form_err'])): ?>
            <div class="alert alert-danger">
                <?php echo $data['form_err']; ?>
            </div>
        <?php endif; ?>
            <h1>Update User Account</h1>

            <!-- User Account Edit Form -->
   

<form action="<?php echo URLROOT; ?>/Admin/editUser/<?php echo $data['users']->regNo; ?>" method="POST" novalidate>

        <?php if(!empty($data['form_err'])): ?>
            <div class="alert alert-danger">
                <?php echo $data['form_err']; ?>
            </div>
        <?php endif; ?>

    <div class="form-group">
        <label for="fullName">Full Name :</label>
        <input type="text" name="fullName" id="fullName" value="<?php echo htmlspecialchars($data['users']->fullName); ?>" required>
    </div>

    <div class="form-group">
        <label for="nameWithInitial">Name With Initials:</label>
        <input type="text" name="nameWithInitial" id="nameWithInitial" value="<?php echo htmlspecialchars($data['users']->nameWithInitial); ?>" required>
    </div>

    <div class="form-group">
        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($data['users']->email); ?>" required>
    </div>

    <div class="form-group">
        <label for="mobileNo">Mobile Number:</label>
        <input type="text" name="mobileNo" id="mobileNo" value="<?php echo htmlspecialchars($data['users']->mobileNo); ?>" required>
    </div>

    <div class="form-group">
        <label for="address">Address:</label>
        <textarea name="address" id="address" rows="2" required><?php echo htmlspecialchars($data['users']->address); ?></textarea>
    </div>

    <div class="form-group">
        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($data['users']->dob); ?>" required>
    </div>

    <div class="form-group">
        <label for="gender">Gender:</label>
        <select name="gender" id="gender" required>
            <option value="Male" <?php if ($data['users']->gender == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($data['users']->gender == 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if ($data['users']->gender == 'Other') echo 'selected'; ?>>Other</option>
        </select>
    </div>

    <div class="form-group">
        <label for="religion">Religion:</label>
        <input type="text" name="religion" id="religion" value="<?php echo htmlspecialchars($data['users']->religion); ?>" required>
    </div>

    <div class="form-group">
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="admin" <?php if ($data['users']->role == 'admin') echo 'selected'; ?>>Admin</option>
            <option value="teacher" <?php if ($data['users']->role == 'teacher') echo 'selected'; ?>>Teacher</option>
            <option value="student" <?php if ($data['users']->role == 'student') echo 'selected'; ?>>Student</option>
            <option value="principal" <?php if ($data['users']->role == 'principal') echo 'selected'; ?>>Principal</option>
            <option value="vice-principal" <?php if ($data['users']->role == 'vice-principal') echo 'selected'; ?>>Vice Principal</option>
            <option value="non-academic" <?php if ($data['users']->role == 'non-academic') echo 'selected'; ?>>Non-academic</option>
            <option value="parent" <?php if ($data['users']->role == 'parent') echo 'selected'; ?>>Parent</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
    <a href="<?php echo URLROOT; ?>/Admin/viewUser" class="btn btn-secondary">Back to List</a>

</form>


            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
