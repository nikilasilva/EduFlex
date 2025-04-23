<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Insert Student Details</h1>

        <!-- Student Form -->
        <form action="<?php echo URLROOT; ?>/Admin/submitStudent" method="POST">


            <!-- Student ID -->
            <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" name="student_id" id="student_id" required>
            </div>

            <!-- User ID -->
            <div class="form-group">
                <label for="regNo">User Reg:</label>
                <input type="number" name="regNo" id="regNo" required>
            </div>

            <!-- First Name -->
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" id="firstName" required>
            </div>

            <!-- Last Name -->
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" id="lastName" required>
            </div>

            <!-- Class ID -->
            <div class="form-group">
    <label for="classId">Class name:</label>
    <select name="classId" id="classId" required>
        <option value="">Select Class</option>
        <optgroup label="Grade 6">
            <option value="1">Grade 6-A</option>
            <option value="2">Grade 6-B</option>
            <option value="3">Grade 6-C</option>
            <option value="4">Grade 6-D</option>
            <option value="5">Grade 6-E</option>
        </optgroup>
        <optgroup label="Grade 7">
            <option value="6">Grade 7-A</option>
            <option value="7">Grade 7-B</option>
            <option value="8">Grade 7-C</option>
            <option value="9">Grade 7-D</option>
            <option value="10">Grade 7-E</option>
        </optgroup>
        <!-- Add similar optgroups for Grade 8 to Grade 11 -->
        <optgroup label="Grade 8">
            <!-- Add options for Grade 8 classes -->
            <option value="11">Grade 8-A</option>
            <option value="12">Grade 8-B</option>
            <option value="13">Grade 8-C</option>
            <option value="14">Grade 8-D</option>
            <option value="15">Grade 8-E</option>
        </optgroup>
        <optgroup label="Grade 9">
            <!-- Add options for Grade 9 classes -->
        </optgroup>
        <optgroup label="Grade 10">
            <!-- Add options for Grade 10 classes -->
        </optgroup>
        <optgroup label="Grade 11">
            <!-- Add options for Grade 11 classes -->
        </optgroup>
    </select>
</div>


            <!-- Guardian (Parent) User ID (Optional) -->
            <div class="form-group">
                <label for="guardianUserID">Guardian (Parent) User ID (optional):</label>
                <input type="number" name="guardianUserID" id="guardianUserID">
            </div>

            <!-- Buttons -->
            <button type="submit" class="btn btn-primary">Submit Student</button><br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewStudent'" class="btn btn-primary">View All Records</button><br><br>
            <a href="<?php echo URLROOT; ?>/admin/dashboard" class="btn btn-secondary">Cancel</a>



                <!-- ################To get users ID ################ -->

        
            <h1>Show User Accounts</h1>

<!-- User Accounts Table -->
<table class="activities-table">
    <thead>
        <tr>
            <th>User Reg</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
        
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['users'] as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user->regNo); ?></td>
              
                <td><?php echo htmlspecialchars($user->username); ?></td>
                <td><?php echo htmlspecialchars($user->email); ?></td>

                <td><?php echo htmlspecialchars($user->role); ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>




 <!-- ################To get users ID ################ -->
        </form>


    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
