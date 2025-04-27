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

           <!-- Error message at the top -->
        <div id="formError" class="form-error-message" style="display:none;"></div>

            <form id="editStudentForm" action="<?php echo URLROOT; ?>/Admin/editStudent/<?php echo $data['student']->regNo; ?>" method="POST" novalidate>

                <div class="form-group">
                    <label for="student_id">Student ID :</label>
                    <input type="text" name="student_id_display" id="student_id_display" readonly value="<?php echo htmlspecialchars($data['student']->student_id); ?>">
                    <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($data['student']->student_id); ?>">
                </div>

                <div class="form-group">
                    <label for="regNo">User Reg :</label>
                    <input type="text" name="regNo" id="regNo" required value="<?php echo htmlspecialchars($data['student']->regNo); ?>">
                </div>

                <div class="form-group">
                    <label for="fullName">Full Name :</label>
                    <input type="text" name="fullName" id="fullName" required value="<?php echo htmlspecialchars($data['user']->fullName); ?>">
                </div>

                <div class="form-group">
                    <label for="nameWithInitial">Name with Initials :</label>
                    <input type="text" name="nameWithInitial" id="nameWithInitial" required value="<?php echo htmlspecialchars($data['user']->nameWithInitial); ?>">
                </div>

                <div class="form-group">
                    <label for="mobileNo">Mobile Number :</label>
                    <input type="text" name="mobileNo" id="mobileNo" required value="<?php echo htmlspecialchars($data['user']->mobileNo); ?>">
                    <div class="error-message" id="mobileNoError"></div>
                </div>

                <div class="form-group">
                    <label for="address">Address :</label>
                    <textarea name="address" id="address" required><?php echo htmlspecialchars($data['user']->address); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="classId">Class Name :</label>
                    <select name="classId" id="classId" required>
                        <option value="">Select Class</option>
                        <?php foreach ($data['classes'] as $class): ?>
                            <option value="<?php echo $class->classId; ?>" 
                                <?php echo ($class->classId == $data['student']->classId) ? 'selected' : ''; ?>>
                                <?php echo $class->className; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
                <a href="<?php echo URLROOT; ?>/Admin/viewStudent" class="btn btn-secondary">Back to List</a>

            </form>

    <!-- Validation Script -->
    <script>
    document.getElementById('editStudentForm').addEventListener('submit', function(event) {
        let isValid = true;

        // Clear previous errors
        document.getElementById('formError').style.display = 'none';
        document.getElementById('mobileNoError').textContent = '';

        const regNo = document.getElementById('regNo').value.trim();
        const fullName = document.getElementById('fullName').value.trim();
        const nameWithInitial = document.getElementById('nameWithInitial').value.trim();
        const mobileNo = document.getElementById('mobileNo').value.trim();
        const address = document.getElementById('address').value.trim();
        const classId = document.getElementById('classId').value.trim();

        // Check all fields filled
        if (!regNo || !fullName || !nameWithInitial || !mobileNo || !address || !classId) {
            document.getElementById('formError').style.display = 'block';
            document.getElementById('formError').textContent = 'Required field is not filled, please check.';
            isValid = false;
        }

        // Check mobile number
        const mobilePattern = /^\d{10}$/;
        if (mobileNo && !mobilePattern.test(mobileNo)) {
            document.getElementById('mobileNoError').textContent = 'Mobile number must be exactly 10 digits.';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
    </script>

    <style>
    .form-error-message {
        color: red;
        font-size: 1rem;
        margin-bottom: 10px;
    }
    .error-message {
        color: red;
        font-size: 0.9rem;
        margin-top: 5px;
    }
    </style>

        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
