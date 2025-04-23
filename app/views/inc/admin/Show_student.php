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
                        <td><?php echo $student->student_id; ?></td>
                        <td><?php echo $student->regNo; ?></td>
                        <td><?php echo $student->firstName . ' ' . $student->lastName; ?></td>
                        <td>
                            <?php
                                $classMap = [
                                    1 => 'Grade 6-A',  2 => 'Grade 6-B',  3 => 'Grade 6-C',  4 => 'Grade 6-D',  5 => 'Grade 6-E',
                                    6 => 'Grade 7-A',  7 => 'Grade 7-B',  8 => 'Grade 7-C',  9 => 'Grade 7-D', 10 => 'Grade 7-E',
                                11 => 'Grade 8-A', 12 => 'Grade 8-B', 13 => 'Grade 8-C', 14 => 'Grade 8-D', 15 => 'Grade 8-E',
                                16 => 'Grade 9-A', 17 => 'Grade 9-B', 18 => 'Grade 9-C', 19 => 'Grade 9-D', 20 => 'Grade 9-E',
                                21 => 'Grade 10-A',22 => 'Grade 10-B',23 => 'Grade 10-C',24 => 'Grade 10-D',25 => 'Grade 10-E',
                                26 => 'Grade 11-A',27 => 'Grade 11-B',28 => 'Grade 11-C',29 => 'Grade 11-D',30 => 'Grade 11-E'
                                ];
                                echo isset($classMap[$student->classId]) ? $classMap[$student->classId] : 'Unknown';
                            ?>
                        </td>

                        <td><?php echo $student->guardianregNo ?? 'N/A'; ?></td>
                        <td>
                            <a href="<?php echo URLROOT; ?>/Admin/editStudent/<?php echo $student->regNo; ?>" class="btn btn-edit">Edit</a><br><br>
                            <a href="<?php echo URLROOT; ?>/Admin/deleteStudent/<?php echo $student->student_id; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
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
