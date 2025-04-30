<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Class Details</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
     <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/insert_actor_style.css">
</head>

<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Insert Class Details</h1>

                <!-- Error message at the top -->
<div id="formError" class="form-error-message" style="display:none;"></div>

        <form id="classForm" action="<?php echo URLROOT; ?>/Admin/submitClass" method="POST" novalidate>

            <!-- Class Name Input -->
            <div class="form-group">
                <label for="className">Class Name:</label>
                <input type="text" name="className" id="className" required>
            </div>

            <div class="form-group">
                <label for="academicYear">Academic Year:</label>
                <input type="text" name="academicYear" id="academicYear" required>
                <div class="error-message" id="academicYearError"></div>
            </div>

            <!-- Buttons -->
            <button type="submit" class="btn btn-primary">Submit Class</button><br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewClass'" class="btn btn-primary">View Class</button><br><br>
            <a href="<?php echo URLROOT; ?>/Dashboard/index" class="btn btn-secondary">Cancel</a>

        </form>

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
                    document.getElementById('academicYearError').textContent = 'Please insert the academic year in the correct format.';
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
