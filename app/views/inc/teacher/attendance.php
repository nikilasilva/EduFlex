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
            <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>"> <!-- Current date -->

            <!-- Dropdown to select class -->
            <label for="class">Select Class:</label>
            <select name="class" id="class" required>
                <option value="">-- Select Class --</option>
                <option value="Grade 6-A">Grade 6-A</option>
                <option value="Grade 6-B">Grade 6-B</option>
                <option value="Grade 7-A">Grade 7-A</option>
                <option value="Grade 7-B">Grade 7-B</option>
                <!-- Add more classes as needed -->
            </select>

            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['students'] as $student): ?>
                        <tr>
                            <td>
                                <input type="hidden" name="student_name[<?= $student['id'] ?>]" value="<?= $student['name'] ?>">
                                <?= $student['id'] ?>
                            </td>
                            <td><?= $student['name'] ?></td>
                            <td>
                                <label>
                                    <input type="radio" name="attendance[<?= $student['id'] ?>]" value="Present" required>
                                    Present
                                </label>
                                <label>
                                    <input type="radio" name="attendance[<?= $student['id'] ?>]" value="Absent">
                                    Absent
                                </label>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <br>
            <button type="submit" class="btn btn-primary">Submit Attendance</button>
        </form>

        <!-- View Attendance form -->
        <form action="<?php echo URLROOT; ?>/teacher/viewAttendance" method="GET">
            <label for="attendance_date">Select Date:</label>
            <input type="date" id="attendance_date" name="attendance_date" required>
            
            <label for="view_class">Select Class:</label>
            <select name="view_class" id="view_class" required>
                <option value="">-- Select Class --</option>
                <option value="Grade 6-A">Grade 6-A</option>
                <option value="Grade 6-B">Grade 6-B</option>
                <option value="Grade 7-A">Grade 7-A</option>
                <option value="Grade 7-B">Grade 7-B</option>
                <!-- Add more classes as needed -->
            </select>

            <button type="submit" class="btn btn-secondary">View Attendance</button>
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>

