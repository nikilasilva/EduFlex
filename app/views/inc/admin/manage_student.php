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
            <!-- <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" name="student_id" id="student_id" required>
            </div> -->

            <!-- User ID -->
            <div class="form-group">
                <label for="regNo">User Reg:</label>
                <input type="number" name="regNo" id="regNo" required>
            </div>


              <!-- Class ID -->
            <div class="form-group">
                <select name="classId" id="classId" required>
                    <option value="">Select Class</option>
                    <?php foreach ($data['classes'] as $class): ?>
                        <option value="<?php echo $class->classId; ?>"><?php echo $class->className; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

          
           



            <!-- Guardian (Parent) User ID (Optional) -->
            <!-- <div class="form-group">
                <label for="guardianUserID">Guardian (Parent) User ID (optional):</label>
                <input type="number" name="guardianUserID" id="guardianUserID">
            </div> -->

            <!-- Buttons -->
            <button type="submit" class="btn btn-primary">Submit Student</button><br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewStudent'" class="btn btn-primary">View All Records</button><br><br>
            <a href="<?php echo URLROOT; ?>/Dashboard/index" class="btn btn-secondary">Cancel</a>



            <h1>Show Student Accounts</h1>

<!-- Student Accounts Table -->
<table class="activities-table">
    <thead>
        <tr>
            <th>Reg No</th>
            <th>Name with Initials</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['users'] as $user): ?>
            <?php if ($user->role === 'student'): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user->regNo); ?></td>
                    <td><?php echo htmlspecialchars($user->nameWithInitial); ?></td>
                    <td><?php echo htmlspecialchars($user->email); ?></td>
                    <td><?php echo htmlspecialchars($user->role); ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>

        </form>


    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
