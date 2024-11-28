<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Class Rooms</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/insert_actor_style.css">
</head>
<body>
<div class="admin_layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content for manage Student -->
    <div class="manage_actor_container">
        <h1>Insert Class Room</h1>

        <!-- Insert Student Details Form -->
        <form action="<?php echo URLROOT; ?>/admin/insertStudentDetails" method="POST" class="actor_form">
            <div class="form-row">
                <label for="classid">Class Room Id:</label>
                <input type="text" name="classid" id="classid" required>
            </div>
            <div class="form-row">
                <label for="className">Class Room Name:</label>
                <input type="text" name="className" id="className" required>
            </div>

            
            <div class="form-row">
                <label for="classadd_day">Class Room Instted day</label>
                <input type="date" name="classadd_day" id="classadd_day" required>
            </div>
            
           
            
            
        
            <div class="form-row">
                <button type="submit" class="submit-button">Insert Class Room</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
