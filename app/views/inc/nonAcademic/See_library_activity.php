<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Activity</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/view_activities.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>See Library Activity</h1>

            <!-- Activities table -->
            <table class="activities-table">
                <thead>
                    <tr>
                        <th>student_id</th>
                        <th>book_id</th>
                        <th>full_name</th>
                        <th>book_name</th>
                        <th>issue_date</th>
                        <th>receipt_date</th>
                        <th>action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['activities'] as $activity): ?>
                        <tr>
                            <td><?php echo $activity->student_id; ?></td>
                            <td><?php echo $activity->book_id; ?></td>
                            <td><?php echo $activity->full_name; ?></td>
                            <td><?php echo $activity->book_name; ?></td>
                            <td><?php echo $activity->issue_date; ?></td>
                            <td><?php echo $activity->receipt_date !== null ? $activity->receipt_date : 'Collected';  ?></td>
                            <td>
                                <a href="<?php echo URLROOT; ?>/Nonacademic/editActivity/<?php echo $activity->student_id; ?>" class="btn btn-edit">Edit</a><br></br>
                                <a href="<?php echo URLROOT; ?>/Nonacademic/deleteActivity/<?php echo $activity->student_id; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this activity?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>