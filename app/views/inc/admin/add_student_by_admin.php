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
<div class="admin_layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content for manage Student -->
    <div class="manage_actor_container">
        <h1>Insert Student Details</h1>

        <!-- Insert Student Details Form -->
        <form action="<?php echo URLROOT; ?>/admin/insertStudentDetails" method="POST" class="actor_form">
            <div class="form-row">
                <label for="regNo">Student Reg No:</label>
                <input type="text" name="regNo" id="regNo" required>
            </div>
            <div class="form-row">
                <label for="fullName">Full Name:</label>
                <input type="text" name="fullName" id="fullName" required>
            </div>
            <div class="form-row">
                <label for="address">Adress:</label>
                <input type="text" name="fullName" id="fullName" required>
            </div>
            <div class="form-row">
                <label for="dob">Date of Birth:</label>
                <input type="date" name="dob" id="dob" required>
            </div>
            <div class="form-row">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Not Selected">Not Selected</option>
                </select>
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
                <label for="class">Class:</label>
                <select name="class" id="class" required>
                    <option value="">Select Grade</option>
                    <option value="Grade 6">Grade 6</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                </select>
            </div>
            <div class="form-row">
                <label for="bloodGroup">Blood Group:</label>
                <select name="bloodGroup" id="bloodGroup" required>
                    <option value="">Select Blood Group</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>
            <div class="form-row">
                <label for="religion">Religion:</label>
                <select name="religion" id="religion" required>
                    <option value="Buddhist">Buddhist</option>
                    <option value="Catholic">Catholic</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Muslim">Muslim</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-row">
                <label for="nationality">Nationality:</label>
                <select name="nationality" id="nationality" required>
                    <option value="">Select Nationality</option>
                    <option value="Sinhales">Sinhales</option>
                    <option value="Sri Lankan Tamil">Sri Lankan Tamil</option>
                    <option value="Sri Lankan Moor">Sri Lankan Moors</option>
                    <option value="Indian Tamil">Indian Tamil</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-row">
                <label for="phone">Phone Number:</label>
                <input type="text" name="phone" id="phone" pattern="\d{10}" title="Phone number should be 10 digits" required>
            </div>
            <div class="form-row">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            
            <div class="form-row">
                <label for="admitiondate">Admition Date:</label>
                <input type="date" name="admitiondate" id="admitiondate" required>
            </div>
            <div class="form-row">
                <label for="aditionalnote">Aditionalnote:</label>
                <input type="text" name="r" id="regNo" required>
                
            </div>
        
            <div class="form-row">
                <button type="submit" class="submit-button">Insert Student</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
