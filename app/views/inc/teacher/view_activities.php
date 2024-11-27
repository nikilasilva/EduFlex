<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Activities</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/view_activities.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="view-activities-container">
        <h1>All Recorded Activities</h1>

        <!-- Activities table -->
        <table class="activities-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Time: from</th>
                    <th>Time: to</th>
                    <th>Subject</th>
                    <th>Class</th>
                    <th>Description</th>
                    <th>Additional Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Check if $data['activities'] is an array or object -->
                <?php if (is_array($data['activities']) || is_object($data['activities'])): ?>
                    <?php foreach ($data['activities'] as $activity): ?>
                        <tr>
                            <td><?php echo $activity->activity_id; ?></td>
                            <td><?php echo $activity->date; ?></td>
                            <td><?php echo $activity->time_from; ?></td>
                            <td><?php echo $activity->time_to; ?></td>
                            <td><?php echo $activity->subject; ?></td>
                            <td><?php echo $activity->class; ?></td>
                            <td><?php echo $activity->description; ?></td>
                            <td><?php echo $activity->additional_note; ?></td>
                            <td>
                                <a href="<?php echo URLROOT; ?>/teacher/editActivity/<?php echo $activity->activity_id; ?>" class="btn btn-edit">Edit</a><br></br>
                                <a href="<?php echo URLROOT; ?>/teacher/deleteActivity/<?php echo $activity->activity_id; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this activity?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Display a message if no activities are found -->
                    <tr>
                        <td colspan="6">No activities found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>


