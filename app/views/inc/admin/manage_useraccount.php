<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert User</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Insert User Details</h1>

        <!-- User Insert Form -->
        <form action="<?php echo URLROOT; ?>/Admin/submitUser" method="POST">

    
            <div class="form-group">
                <label for="firstName">First Name :</label>
                <input type="text" name="firstName" id="firstName" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name :</label>
                <input type="text" name="lastName" id="lastName" required>
            </div>

            <div class="form-group">
                <label for="username">Username :</label>
                <input type="text" name="username" id="username" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="mobileNo">Mobile Number :</label>
                <input type="text" name="mobileNo" id="mobileNo" required>
            </div>

            <div class="form-group">
                <label for="address">Address :</label>
                <textarea name="address" id="address" rows="2" required></textarea>
            </div>

            <div class="form-group">
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth :</label>
                <input type="date" name="dob" id="dob" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender :</label>
                <select name="gender" id="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="religion">Religion :</label>
                <input type="text" name="religion" id="religion" required>
            </div>

            <div class="form-group">
                <label for="role">Role :</label>
                <select name="role" id="role" required>
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                    <option value="principal">Principal</option>
                    <option value="vice-principal">Vice Principal</option>
                    <option value="non-academic">Non-Academic</option>
                    <option value="parent">Parent</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit User</button><br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewUser'" class="btn btn-primary">View Users</button><br><br>
            <a href="<?php echo URLROOT; ?>/teacher/viewActivities" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>
<?php require APPROOT.'/views/inc/footer.php'; ?>
