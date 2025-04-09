<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>
<div class="add-user-container">
    <h1>Add User</h1>
    <form action="<?php echo URLROOT; ?>/admin/addUser" method="POST">
        <div class="add-user-form-group">
            <label>Email:</label>
            <input type="email" name="email" class="add-user-form-control <?php echo !empty($errors['email']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['email'] ?? ''; ?>">
            <span class="invalid-feedback"><?php echo $errors['email'] ?? ''; ?></span>
        </div>
        <div class="form-group">
            <label>Mobile Number:</label>
            <input type="text" name="mobileNo" class="add-user-form-control" value="<?php echo $_POST['mobileNo'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label>Address:</label>
            <textarea name="address" class="add-user-form-control"><?php echo $_POST['address'] ?? ''; ?></textarea>
        </div>
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" class="add-user-form-control <?php echo !empty($errors['username']) ? 'is-invalid' : ''; ?>" value="<?php echo $_POST['username'] ?? ''; ?>">
            <span class="invalid-feedback"><?php echo $errors['username'] ?? ''; ?></span>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="add-user-form-control <?php echo !empty($errors['password']) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $errors['password'] ?? ''; ?></span>
        </div>
        <div class="form-group">
            <label>Date of Birth:</label>
            <input type="date" name="dob" class="add-user-form-control" value="<?php echo $_POST['dob'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label>Gender:</label>
            <select name="gender" class="add-user-form-control-select">
                <option value="Male" <?php echo ($_POST['gender'] ?? '') === 'Male' ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo ($_POST['gender'] ?? '') === 'Female' ? 'selected' : ''; ?>>Female</option>
                <option value="Other" <?php echo ($_POST['gender'] ?? '') === 'Other' ? 'selected' : ''; ?>>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label>Religion:</label>
            <input type="text" name="religion" class="add-user-form-control" value="<?php echo $_POST['religion'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label>Role:</label>
            <select name="role" class="add-user-form-control-select">
                <option value="teacher" <?php echo ($_POST['role'] ?? '') === 'teacher' ? 'selected' : ''; ?>>Teacher</option>
                <option value="student" <?php echo ($_POST['role'] ?? '') === 'student' ? 'selected' : ''; ?>>Student</option>
                <option value="principal" <?php echo ($_POST['role'] ?? '') === 'principal' ? 'selected' : ''; ?>>Principal</option>
                <option value="vice-principal" <?php echo ($_POST['role'] ?? '') === 'vice-principal' ? 'selected' : ''; ?>>Vice Principal</option>
                <option value="non-academic" <?php echo ($_POST['role'] ?? '') === 'non-academic' ? 'selected' : ''; ?>>Non Academic Staff</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>

        <a href="<?php echo URLROOT; ?>/Admin/listUsers" class="btn btn-secondary">View All Users</a>
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
