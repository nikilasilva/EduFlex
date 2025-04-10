<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/attendance.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="attendance-container">
        <h1>Attendance</h1>

        <!-- Attendance form -->
        <form action="<?php echo URLROOT; ?>/teacher/submitAttendance" method="POST">
            <!-- Automatically include current date -->
            <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
            <input type="hidden" name="class" value="<?= $class ?? '' ?>">
            <table border="1" class="attendance-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                
                <tbody>
                <?php if (!empty($students) && is_array($students)): ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            
                            <td><?= htmlspecialchars($student->student_id) ?></td>
                            <td><?= htmlspecialchars($student->name) ?></td>
                            <input type="hidden" name="student_name[<?= $student->student_id ?>]" value="<?= $student->name ?>">
                            <td>
    <label style="display: inline-block; margin-right: 10px;">
        <input type="radio" 
               name="attendance[<?= $student->student_id ?>]" 
               value="present" 
               required>
        Present
    </label>

    <label style="display: inline-block;">
        <input type="radio" 
               name="attendance[<?= $student->student_id ?>]" 
               value="absent">
        Absent
    </label>
</td>


                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No Students Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>

            </table>
            
            <br>
            <button type="submit" class="btn btn-primary">Submit Attendance</button>
        </form>

        <!-- View Attendance form -->
        <form action="<?php echo URLROOT; ?>/teacher/viewAttendance" method="GET">
            <label for="attendance_date">Select Date:</label>
            <input type="date" id="attendance_date" name="attendance_date" required>
            
            <!-- Class will be automatically selected from the previous form -->
            <input type="hidden" name="view_class" value="<?= $class ?? '' ?>">

            <button type="submit" class="btn btn-secondary">View Attendance</button>
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>


