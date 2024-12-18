<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Insert Teacher</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css.css">
</head>
<body>
<div class="admin_layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content for manage Student -->
    <div class="manage_actor_container">
        <h1>Insert Teacher</h1>

        <!-- Insert Student Details Form -->
        <form action="<?php echo URLROOT; ?>/admin/insertteachersubmit" method="POST" class="actor_form">
            <div class="form-row">
                <label for="tea_id">Teacher Id:</label>
                <input type="text" name="tea_id" id="tea_id" required >
                
            </div>
            <div class="form-row">
                <label for="tea_fullName">Teacheer Full Name:</label>
                <input type="text" name="tea_fullName" id="tea_fullName" required>
               
            </div>
            <div class="form-row">
                <label for="tea_subject">Subject:</label>
                <input type="text" name="tea_subject" id="tea_subject" required>
                
            </div>
           
            <div class="form-row">
                <label for="tea_addres">Teacher Addres:</label>
                <input type="text" name="tea_addres" id="tea_addres" required>
                
            </div>
            
            
            <div class="form-row">
                <label for="tea_dob">Teacher Date of Birth:</label>
                <input type="date" name="tea_dob" id="tea_dob" required>
                
            </div>

            <div class="form-row">
                <label for="tea_appointeddate">Appointed Date:</label>
                <input type="date" name="tea_appointeddate" id="tea_appointeddate"  required>
                
            </div>
            
            <div class="form-row">
                <label for="tea_phone">Teacher Phone Number:</label>
                <input type="text" name="tea_phone" id="tea_phone" pattern="\d{10}" title="Phone number should be 10 digits" required>
                
            </div>
            <div class="form-row">
                <label for="tea_email">Teacher Email:</label>
                <input type="email" name="tea_email" id="tea_email" >
                
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
