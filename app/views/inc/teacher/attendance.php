<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
</head>
<body>
<div class="layout">
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <div class="attendance-container">
        <h1>Attendance</h1>

        <?php if (!empty($data['errors']['general'])): ?>
            <div id= "flash-message" class="alert alert-danger">
                <?= htmlspecialchars($data['errors']['general']) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($data['success'])): ?>
            
            <div id= "flash-message" class="alert alert-success">
                <?= htmlspecialchars($data['success']) ?>
            </div>
        <?php endif; ?>

        <!-- Attendance form -->
        <form action="<?= URLROOT; ?>/teacher/submitAttendance" method="POST">
            <input type="hidden" name="date" value="<?= date('Y-m-d'); ?>">
            <input type="hidden" name="class" value="<?= $data['class'] ?? '' ?>">

            <table border="1" class="attendance-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($data['students']) && is_array($data['students'])): ?>
                    <?php foreach ($data['students'] as $student): ?>
                        <tr>
                            <td><?= htmlspecialchars($student->student_id) ?></td>
                            <td><?= htmlspecialchars($student->firstName . ' ' . $student->lastName) ?></td>

                            <input type="hidden" name="student_name[<?= $student->student_id ?>]" 
                                   value="<?= htmlspecialchars($student->firstName . ' ' . $student->lastName) ?>">

                            <td>
                                <label style="margin-right: 10px;">
                                    <input type="radio" 
                                           name="attendance[<?= $student->student_id ?>]" 
                                           value="present"
                                           <?= isset($data['oldInput']['attendance'][$student->student_id]) && $data['oldInput']['attendance'][$student->student_id] === 'present' ? 'checked' : '' ?>>
                                    Present
                                </label>
                                <label>
                                    <input type="radio" 
                                           name="attendance[<?= $student->student_id ?>]" 
                                           value="absent"
                                           <?= isset($data['oldInput']['attendance'][$student->student_id]) && $data['oldInput']['attendance'][$student->student_id] === 'absent' ? 'checked' : '' ?>>
                                    Absent
                                </label>
                                <?php if (!empty($data['errors']['attendance'][$student->student_id])): ?>
                                    <div class="error-message" style="color: red; margin-bottom: 10px;">
                                    <span class="error"><?= htmlspecialchars($data['errors']['attendance'][$student->student_id]) ?></span>
                                    </div>
                                <?php endif; ?>
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
        <form action="<?= URLROOT; ?>/teacher/viewAttendance" method="GET">
            <label for="attendance_date">Select Date:</label>
            <input type="date" id="attendance_date" name="attendance_date" max="<?= date('Y-m-d') ?>" required>
            <input type="hidden" name="view_class" value="<?= $data['class'] ?? '' ?>">
            <button type="submit" class="btn btn-secondary">View Attendance</button>
        </form>

        <!-- View Absence Reports form -->
        <form action="<?= URLROOT; ?>/teacher/viewAbsences" method="GET">
            <label for="absence_date">Select Date:</label>
            <input type="date" id="absence_date" name="attendance_date" max="<?= date('Y-m-d') ?>" required>
            <input type="hidden" name="class" value="<?= $data['class'] ?? '' ?>">
            <button type="submit" class="btn btn-warning">View Absence Reports</button>
        </form>
        <a href="<?php echo URLROOT; ?>/teacher/selectClassForAttendance" class="btn-back">
    << Back
</a>
    </div>
</div>


</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>


