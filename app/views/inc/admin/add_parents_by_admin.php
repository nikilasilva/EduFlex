<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/insert_actor_style.css">

</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content for manage Student -->
    <div class="manage_actor_container">
        <h1>Insert Parent Details</h1>

        <!-- Insert Student Details Form -->
        <form action="<?php echo URLROOT; ?>/admin/insertStudentDetails" method="POST" class="student_form">
            <div class="form-row">
                <label for="regNo">Student Reg No:</label>
                <input type="text" name="regNo" id="regNo" required>
            </div>
            <div class="form-row">
                <label for="fullName">Student Full Name:</label>
                <input type="text" name="fullName" id="fullName" required>
            </div>
           
            <div class="form-row">
                <label for="parentName">Parent Name:</label>
                <input type="text" name="parentName" id="parentName" required>
            </div>
            <div class="form-row">
                <label for="parentRelation">Relationship to Parent:</label>
                <select name="parentRelation" id="parentRelation" required>
                    <option value="">Select parent</option>
                    <option value="Mother">Mother</option>
                    <option value="Father">Father</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            
            <div class="form-row">
                <label for="parentdob">Parent Date of Birth:</label>
                <input type="date" name="parentdob" id="parentdob" required>
            </div>
            
            <div class="form-row">
                <label for="Parent_phone">Parent Phone Number:</label>
                <input type="text" name="Parentphone" id="Parentphone" pattern="\d{10}" title="Phone number should be 10 digits" required>
            </div>
            <div class="form-row">
                <label for="Parentemail">Parent Email:</label>
                <input type="email" name="parentemail" id="email" >
            </div>
            
        
            <div class="form-row">
                <button type="submit" class="submit-button">Insert Parent</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
