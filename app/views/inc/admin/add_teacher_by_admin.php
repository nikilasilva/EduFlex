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
<div class="admin_layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content for manage Student -->
    <div class="manage_actor_container">
        <h1>Insert Teacher</h1>

        <!-- Insert Student Details Form -->
        <form action="<?php echo URLROOT; ?>/admin/insertStudentDetails" method="POST" class="actor_form">
            <div class="form-row">
                <label for="regNo">Teacher Id:</label>
                <input type="text" name="teaid" id="teaid" required>
            </div>
            <div class="form-row">
                <label for="fullName">Teacheer Full Name:</label>
                <input type="text" name="tachfullName" id="tachfullName" required>
            </div>
           
            <div class="form-row">
                <label for="teacheraddress">Teacher Addres:</label>
                <input type="text" name="teacheraddres" id="teacheraddres" required>
            </div>
            
            
            <div class="form-row">
                <label for="teacherdob">Teacher Date of Birth:</label>
                <input type="date" name="teacherdob" id="teacherdob" required>
            </div>
            
            <div class="form-row">
                <label for="Parent_phone">Teacher Phone Number:</label>
                <input type="text" name="teacherphone" id="teacherphone" pattern="\d{10}" title="Phone number should be 10 digits" required>
            </div>
            <div class="form-row">
                <label for="Teacheremail">Teacher Email:</label>
                <input type="email" name="parentemail" id="email" >
            </div>
            
        
            <div class="form-row">
                <button type="submit" class="submit-button">Insert Teacher</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
