<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Books</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Update Principal Details </h1>



            <!-- Daily Activities form -->
            <!-- <form action="<?php echo URLROOT; ?>/NonAcademic/editActivity" method="POST"> -->
<!-- Error message at the top -->
<div id="formError" class="form-error-message" style="display:none;"></div>

        <form id="editPrincipalForm" action="<?php echo URLROOT; ?>/Admin/editPrincipal/<?php echo $data['principal']->principalId; ?>" method="POST" novalidate>

            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" name="fullName" id="fullName" value="<?php echo htmlspecialchars($data['principal']->fullName); ?>" required>
            </div>

            <div class="form-group">
                <label for="nameWithInitial">Name with Initials:</label>
                <input type="text" name="nameWithInitial" id="nameWithInitial" value="<?php echo htmlspecialchars($data['principal']->nameWithInitial); ?>" required>
            </div>

            <div class="form-group">
                <label for="experience">Years of Experience:</label>
                <input type="number" name="experience" id="experience" value="<?php echo htmlspecialchars($data['principal']->experience); ?>" required>
                <div class="error-message" id="experienceError"></div>
            </div>

            <div class="form-group">
                <label for="hireDate">Hire Date:</label>
                <input type="date" name="hireDate" id="hireDate" value="<?php echo htmlspecialchars($data['principal']->hireDate); ?>" required>
                <div class="error-message" id="hireDateError"></div>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
         

        </form>

        <!-- Validation Script -->
        <script>
        document.getElementById('editPrincipalForm').addEventListener('submit', function(event) {
            let isValid = true;

            // Clear previous errors
            document.getElementById('formError').style.display = 'none';
            document.getElementById('experienceError').textContent = '';
            document.getElementById('hireDateError').textContent = '';

            const fullName = document.getElementById('fullName').value.trim();
            const nameWithInitial = document.getElementById('nameWithInitial').value.trim();
            const experience = document.getElementById('experience').value.trim();
            const hireDate = document.getElementById('hireDate').value.trim();

            // Check all fields filled
            if (!fullName || !nameWithInitial || !experience || !hireDate) {
                document.getElementById('formError').style.display = 'block';
                document.getElementById('formError').textContent = 'Required field is not filled, please check.';
                isValid = false;
            }

            // Validate experience
            if (experience && experience < 0) {
                document.getElementById('experienceError').textContent = 'Incorrect input.';
                isValid = false;
            }

            // Validate hire date
            if (hireDate) {
                const selectedDate = new Date(hireDate);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate > today) {
                    document.getElementById('hireDateError').textContent = 'Hire date cannot be a future date.';
                    isValid = false;
                }
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

    <a href="<?php echo URLROOT; ?>/Admin/viewPrincipal" class="btn btn-secondary">Back to List</a>



           
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>