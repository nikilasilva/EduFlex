<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>

<body>
    <div class="layout">
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <div class="container">
            <h1>Update Student Details</h1>

            <form action="<?php echo URLROOT; ?>/Admin/editStudent/<?php echo $data['student']->regNo; ?>" method="POST">


            <div class="form-group">
                    <label for="student_id">Student ID :</label>
                    <input type="text" name="student_id" id="student_id" required value="<?php echo htmlspecialchars($data['student']->student_id); ?>">
                </div>
                
                <div class="form-group">
                    <label for="regNo">User ID :</label>
                    <input type="text" name="regNo" id="regNo" required value="<?php echo htmlspecialchars($data['student']->regNo); ?>">
                </div>

                <div class="form-group">
                    <label for="firstName">First Name :</label>
                    <input type="text" name="firstName" id="firstName" required value="<?php echo htmlspecialchars($data['student']->firstName); ?>">
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name :</label>
                    <input type="text" name="lastName" id="lastName" required value="<?php echo htmlspecialchars($data['student']->lastName); ?>">
                </div>

                <div class="form-group">
                    <label for="classId">Class Name :</label>
                    <select name="classId" id="classId" required>
                        <option value="">Select Class</option>
                        <?php
                            $classMap = [
                            1 => 'Grade 6-A',  2 => 'Grade 6-B',  3 => 'Grade 6-C',  4 => 'Grade 6-D',  5 => 'Grade 6-E',
                            6 => 'Grade 7-A',  7 => 'Grade 7-B',  8 => 'Grade 7-C',  9 => 'Grade 7-D', 10 => 'Grade 7-E',
                            11 => 'Grade 8-A', 12 => 'Grade 8-B', 13 => 'Grade 8-C', 14 => 'Grade 8-D', 15 => 'Grade 8-E',
                            16 => 'Grade 9-A', 17 => 'Grade 9-B', 18 => 'Grade 9-C', 19 => 'Grade 9-D', 20 => 'Grade 9-E',
                            21 => 'Grade 10-A',22 => 'Grade 10-B',23 => 'Grade 10-C',24 => 'Grade 10-D',25 => 'Grade 10-E',
                            26 => 'Grade 11-A',27 => 'Grade 11-B',28 => 'Grade 11-C',29 => 'Grade 11-D',30 => 'Grade 11-E'
                            ];
                            foreach ($classMap as $value => $name):
                        ?>
                            <option value="<?php echo $value; ?>" <?php echo ($data['student']->classId == $value) ? 'selected' : ''; ?>>
                                <?php echo $name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>


             

                <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
                <a href="<?php echo URLROOT; ?>/Admin/viewStudent" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
