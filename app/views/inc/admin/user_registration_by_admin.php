<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Insert Teacher</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/insert_actor_style.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content for manage Student -->
    <div class="manage_student_container">
        <h1>User Registration</h1>

        <!-- Insert Student Details Form -->
        <form action="<?php echo URLROOT; ?>/admin/insertStudentDetails" method="POST" class="student_form">
            <div class="form-row">
                <label for="regNo">User Id:</label>
                <input type="text" name="teaid" id="teaid" required>
            </div>
            <div class="form-row">
                <label for="userName">User Name:</label>
                <input type="text" name="userName" id="userName" required>
            </div>
           
        
            <div class="form-row">
                <label for="Useremail">User Email:</label>
                <input type="email" name="useremail" id="useremail">
            </div>

            <div class="form-row">
                <label for="Userpassword">User PassWord:</label>
                <input type="password" name="userpassword" id="userpassword">
            </div>

            <div class="form-row">
                <label for="Useremail">User Role:</label>
                <input type="text" name="userole" id="userole">
            </div>

            <div class="form-row">
                <label for="createdate">Created Date:</label>
                <input type="date" name="createddate" id="createddate">
            </div>
            
        
            <div class="form-row">
                <button type="submit" class="submit-button">Insert User</button>
            </div>
            <div class="form-row">
                <button type="submit" class="submit-button">View All User</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
