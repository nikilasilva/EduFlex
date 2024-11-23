<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable</title>
    
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/scheduledEvents.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="timetable-container">
        <h1>Grade 6-A Timetable</h1>
        <div class="timetable">
            <table>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['timeTable'] as $row): ?>
                        <tr>
                            <td><?= $row['time'] ?></td>
                            <td><?= $row['monday'] ?></td>
                            <td><?= $row['tuesday'] ?></td>
                            <td><?= $row['wednesday'] ?></td>
                            <td><?= $row['thursday'] ?></td>
                            <td><?= $row['friday'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
