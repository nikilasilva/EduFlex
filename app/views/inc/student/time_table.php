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
        <h1>Timetable</h1>
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
            <?php foreach ($timetable as $timeSlot => $days): ?>
                <tr>
                    <td><?= htmlspecialchars($timeSlot) ?></td>
                    <?php foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day): ?>
                        <td>
                            <?php if (isset($days[$day])): ?>
                                <?= htmlspecialchars($days[$day]['subject']) ?><br>
                                <!-- <small><?= htmlspecialchars($days[$day]['teacher']) ?></small> -->
                                
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
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