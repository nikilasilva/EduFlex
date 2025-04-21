<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/teacher.css">
</head>

<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Student Details</h1>

        <!-- Student details table -->
        <table class="activities-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>User Reg</th>
                    <th>Full Name</th>
                    <th>Class Name</th>
                    <th>Guardian User ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['students'] as $student): ?>
                    <tr>
                        <td><?php echo $student->studentId; ?></td>
                        <td><?php echo $student->regNo; ?></td>
                        <td><?php echo $student->firstName . ' ' . $student->lastName; ?></td>
                        <td><?php echo $student->classId; ?></td>
                        <td><?php echo $student->guardianregNo ?? 'N/A'; ?></td>
                        <td>
                            <a href="<?php echo URLROOT; ?>/Admin/editStudent/<?php echo $student->studentId; ?>" class="btn btn-edit">Edit</a><br><br>
                            <a href="<?php echo URLROOT; ?>/Admin/deleteStudent/<?php echo $student->studentId; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
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
