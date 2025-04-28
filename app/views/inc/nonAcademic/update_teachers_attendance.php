<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Attendance</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/attendance.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main Content -->
        <div class="attendance-container">
            <h1>Update Teachers Attendance</h1>

            <!-- Display Current Date -->
            <div class="current-date">
                <p><strong>Date:</strong> <?php echo date('Y-m-d'); ?></p>
            </div>

            <!-- Attendance Form -->
            <form action="<?php echo URLROOT; ?>/nonAcademic/SubmitUpdatedTeachersAttendance" method="POST">
                <input type="hidden" name="date" value="<?php echo htmlspecialchars($data['date']); ?>">
                <table border="1" cellpadding="10" class="attendance-table">
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
                                    <?php echo htmlspecialchars($teacher->teacher_id); ?>
                                    <input type="hidden" name="teacher_ids[]" value="<?php echo htmlspecialchars($teacher->teacher_id); ?>">
                                </td>
                                <td><?php echo htmlspecialchars($teacher->firstName . ' ' . $teacher->lastName); ?></td>
                                <td>
                                    <div style="display: flex; gap: 15px;">
                                        <label>
                                            <input type="radio" name="attendance[<?php echo $teacher->teacher_id; ?>]" value="present"
                                                <?php echo isset($data['attendance'][$teacher->teacher_id]) && $data['attendance'][$teacher->teacher_id] === 'present' ? 'checked' : ''; ?>>
                                            Present
                                        </label>
                                        <label>
                                            <input type="radio" name="attendance[<?php echo $teacher->teacher_id; ?>]" value="absent"
                                                <?php echo isset($data['attendance'][$teacher->teacher_id]) && $data['attendance'][$teacher->teacher_id] === 'absent' ? 'checked' : ''; ?>>
                                            Absent
                                        </label>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <br>
                <button type="submit" class="btn btn-primary">Update Attendance</button>
            </form>
        </div>
    </div>
</body>

</html>
<?php require APPROOT . '/views/inc/footer.php'; ?>