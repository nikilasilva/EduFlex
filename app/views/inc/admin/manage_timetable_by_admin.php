<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Timetable</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/adminActivityStyle.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content for managing Timetable -->
    <div class="manage_by_admin">
        <h1>Manage Time Table</h1>

        <!-- Timetable Type Selection -->
        <div class="timetable_type">
            <label for="timetableType">
                <h3>Select Timetable Type</h3>
            </label>
            <select name="timetableType" id="timetableType">
                <option value="">Select Time Table Type</option>
                <option value="Academic">Academic Timetable</option>
                <option value="Extracurricular">Extracurricular Activities</option>
            </select>
        </div>

        <!-- Manage Timetable Buttons -->
        <div class="manage_buttons">
            <button onclick="window.location.href='<?php echo URLROOT; ?>/students/insert'">Insert</button>
            <button onclick="window.location.href='<?php echo URLROOT; ?>/students/view'">View</button>
            <button onclick="window.location.href='<?php echo URLROOT; ?>/students/update'">Update</button>
            <button id="delete" onclick="window.location.href='<?php echo URLROOT; ?>/students/delete'">Delete</button>
        </div>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
