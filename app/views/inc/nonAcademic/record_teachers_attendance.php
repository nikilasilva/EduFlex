<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
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
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="attendance-container">
            <h1>Record Teachers Attendance</h1>

            <!-- Display current date -->
            <div class="current-date">
                <p><strong>Date:</strong> <?php echo date('Y-m-d'); ?></p>
            </div>

            <!-- Attendance form -->
            <form action="<?php echo URLROOT; ?>/nonAcademic/SubmitTeachersAttendanceForm" method="POST">
                <table border="1" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Teacher ID</th>
                            <th>Teacher Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['teachers'] as $teacher): ?>
                            <tr>
                                <td>
                                    <?php echo $teacher->teacher_id; ?>
                                    <input type="hidden" name="teacher_ids[]" value="<?php echo $teacher->teacher_id; ?>">
                                </td>
                                <td><?php echo $teacher->first_name . ' ' . $teacher->last_name; ?></td>
                                <td>
                                    <div style="display: flex; gap: 15px;">
                                        <label>
                                            <input type="radio" name="attendance[<?php echo $teacher->teacher_id; ?>]" value="present" required> Present
                                        </label>
                                        <label>
                                            <input type="radio" name="attendance[<?php echo $teacher->teacher_id; ?>]" value="absent" required> Absent
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                

                <br>
                <button type="submit" class="btn btn-primary">Submit Attendance</button>
            </form>
        </div>
    </div>
</body>



</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
