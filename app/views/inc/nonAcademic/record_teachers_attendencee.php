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
            <h1>Record Teachers Attendencee</h1>

            <!-- Attendance form -->
            <form action="<?php echo URLROOT; ?>/nonAcademic/submitAttendance" method="POST">
                <table>
                    <thead>
                        <tr>
                            <th>teacher ID</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['attendance'] as $recode): ?>
                            <tr>


                                <td><?php echo $activity->teacher_id; ?></td>
                                <td><?php echo $activity->sttendance; ?></td>






                                <!-- <td><?= $student['id'] ?></td>
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
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <br></br>
                <button type="submit" class="btn btn-primary">Submit Attendance</button><br></br>
                <button type="submit" class="btn btn-primary">View Attendance</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>