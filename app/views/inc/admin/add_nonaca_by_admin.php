<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Non-Academic</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/insert_actor_style.css">
</head>
<body>
<div class="admin_layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content for manage Student -->
    <div class="manage_actor_container">
        <h1>Insert Non Academic</h1>

        <!-- Insert Student Details Form -->
        <form action="<?php echo URLROOT; ?>/admin/insertStudentDetails" method="POST" class="actor_form">
            <div class="form-row">
                <label for="nonacid">Non Academic Id:</label>
                <input type="text" name="nonacid" id="nonacid" required>
            </div>
            <div class="form-row">
                <label for="nonacfullname">Non Academic Full Name:</label>
                <input type="text" name="nonacfullname" id="nonacfullname" required>
            </div>
           
            <div class="form-row">
                <label for="nonacaddress">Non Academic Addres:</label>
                <input type="text" name="nonacaddress" id="nonacaddress" required>
            </div>
            
            
            <div class="form-row">
                <label for="nonacdob">Non Academic Date of Birth:</label>
                <input type="date" name="nonacdob" id="nonacdob" required>
            </div>
            
            <div class="form-row">
                <label for="nonacphone">Non Academic Phone Number:</label>
                <input type="text" name="nonacphone" id="nonacphone" pattern="\d{10}" title="Phone number should be 10 digits" required>
            </div>
            <div class="form-row">
                <label for="nonacemail">Non Academic Email:</label>
                <input type="email" name="nonacemail" id="nonacemail" >
            </div>
            
        
            <div class="form-row">
                <button type="submit" class="submit-button">Insert Non-Academic</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
