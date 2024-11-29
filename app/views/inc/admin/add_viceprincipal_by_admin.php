<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Insert Vice Principal</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/insert_actor_style.css">
</head>
<body>
<div class="admin_layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content for manage Student -->
    <div class="manage_actor_container">
        <h1>Insert Vice-Principal</h1>

        <!-- Insert Student Details Form -->
        <form action="<?php echo URLROOT; ?>/admin/insertStudentDetails" method="POST" class="actor_form">
            <div class="form-row">
                <label for="ViceregNo">Vice-Principal Id:</label>
                <input type="text" name="viceprinid" id="viceprinid" required>
            </div>
            <div class="form-row">
                <label for="fullName">Vice-Principal Full Name:</label>
                <input type="text" name="viceprinfullName" id="viceprinfullName" required>
            </div>
           
            <div class="form-row">
                <label for="viceprinaddress">Vice-Principal Addres:</label>
                <input type="text" name="viceprinaddress" id="viceprinaddress" required>
            </div>
            
            
            <div class="form-row">
                <label for="vicprindob">Vice-Principal Date of Birth:</label>
                <input type="date" name="vicprindob" id="vicprindob" required>
            </div>
            
            <div class="form-row">
                <label for="viceprinphone">Vice-Principal Phone Number:</label>
                <input type="text" name="viceprinphone" id="viceprinphone" pattern="\d{10}" title="Phone number should be 10 digits" required>
            </div>
            <div class="form-row">
                <label for="viceprinemail">Vice-Principal Email:</label>
                <input type="email" name="viceprinemail" id="viceprinemail" >
            </div>
            
        
            <div class="form-row">
                <button type="submit" class="submit-button">Insert Vice Principal</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
