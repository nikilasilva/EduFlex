<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class Details</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/style.css">
</head>

<body>
    <div class="layout">
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>
        <div class="container">
            <h1>Edit Class Details</h1>

            <!-- Error message at the top -->
            <div id="formError" class="form-error-message" style="display:none;"></div>

            <form id="classForm" action="<?php echo URLROOT; ?>/Admin/editClass/<?php echo $data['class']->classId; ?>" method="POST" novalidate>
                <!-- Class Name Input -->
                <div class="form-group">
                    <label for="className">Class Name:</label>
                    <input type="text" name="className" id="className" value="<?php echo $data['class']->className; ?>" required>
                </div>

                <!-- Academic Year Input -->
                <div class="form-group">
                    <label for="academicYear">Academic Year:</label>
                    <input type="text" name="academicYear" id="academicYear" value="<?php echo $data['class']->academicYear; ?>" required>
                    <div class="error-message" id="academicYearError"></div>
                </div>

                <!-- Buttons -->
                <button type="submit" class="btn btn-primary">Update Class</button><br><br>
                <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewClass'" class="btn btn-primary">View Class</button><br><br>
                <a href="<?php echo URLROOT; ?>/Dashboard/index" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <!-- Validation Script -->
    <script>
    document.getElementById('classForm').addEventListener('submit', function(event) {
        let isValid = true;

        // Clear previous errors
        document.getElementById('formError').style.display = 'none';
        document.getElementById('academicYearError').textContent = '';

        const className = document.getElementById('className').value.trim();
        const academicYear = document.getElementById('academicYear').value.trim();

        // Validate all fields
        if (!className || !academicYear) {
            document.getElementById('formError').style.display = 'block';
            document.getElementById('formError').textContent = 'Required field is not filled please check.';
            isValid = false;
        }

        // Validate academic year format
        const academicYearPattern = /^[0-9]{4}-[0-9]{4}$/;
        if (academicYear && !academicYearPattern.test(academicYear)) {
            document.getElementById('academicYearError').textContent = 'Please insert the academic year in the correct format (e.g., 2024-2025).';
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
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
