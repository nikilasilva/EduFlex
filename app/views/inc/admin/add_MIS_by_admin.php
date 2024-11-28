<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert MIS</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/insert_actor_style.css">
</head>
<body>
<div class="admin_layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content for manage Student -->
    <div class="manage_actor_container">
        <h1>Insert MIS</h1>

        <!-- Insert Student Details Form -->
        <form action="<?php echo URLROOT; ?>/admin/insertStudentDetails" method="POST" class="actor_form">
            <div class="form-row">
                <label for="regNo">#########</label>
                <input type="text" name="prinid" id="prinid" required>
            </div>
            <div class="form-row">
                <label for="fullName">##########</label>
                <input type="text" name="prinfullName" id="prinfullName" required>
            </div>
           
            <div class="form-row">
                <label for="prinaddress">###########</label>
                <input type="text" name="prinaddress" id="prinaddress" required>
            </div>
            
            
            
            
           
           
            
        
            <div class="form-row">
                <button type="submit" class="submit-button">Insert MIS</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
