<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/attendance.css">
    <style>
        .change-date {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .change-date input[type="date"] {
            padding: 6px 10px;
            font-size: 16px;
        }

        .change-date button {
            padding: 6px 15px;
            font-size: 16px;
            background-color: #2c7be5;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .change-date button:hover {
            background-color: #1a5bb8;
        }
    </style>
</head>

<body>
    <div class="layout">
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <div class="attendance-container">
            <h1>Teachers Attendance Records</h1>

            <!-- Date Picker -->
            <div class="change-date">
                <form method="get" action="<?php echo URLROOT; ?>/NonAcademic/ViewTeachersAttendance">
                    <label for="date">Select Date:</label>
                    <input type="date" name="date" id="date" value="<?php echo isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'); ?>" required>
                    <button type="submit">Change Date</button>
                </form>
            </div>

            <!-- Attendance Table -->
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>Teacher Name</th>
                        <th>Teacher ID</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
                    $recordsFound = false;

                    if (!empty($data['attendance'])):
                        foreach ($data['attendance'] as $record):
                            if ($record->attendance_date === $selectedDate):
                                $recordsFound = true;
                    ?>
                                <tr>
                                    <td>
                                        <?php
                                        $tid = $record->teacher_id;
                                        echo isset($data['teachers'][$tid]) 
                                            ? $data['teachers'][$tid]->firstName . ' ' . $data['teachers'][$tid]->lastName 
                                            : 'Unknown';
                                        ?>
                                    </td>
                                    <td><?php echo $record->teacher_id; ?></td>
                                    <td><?php echo ucfirst($record->status); ?></td>
                                </tr>
                    <?php
                            endif;
                        endforeach;
                    endif;

                    if (!$recordsFound):
                    ?>
                        <tr>
                            <td colspan="3">No attendance records found for <?php echo $selectedDate; ?>.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
<?php require APPROOT . '/views/inc/footer.php'; ?>
