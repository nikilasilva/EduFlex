<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Non-Academic Staff</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/style.css">
</head>

<body>
    <div class="layout">
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>
        <div class="container">
            <h1>Edit Non-Academic Staff Details</h1>

<!-- Error message at the top -->
<div id="formError" class="form-error-message" style="display:none;"></div>

        <form id="editNonacaForm" action="<?php echo URLROOT; ?>/Admin/editNonaca/<?php echo $data['nonaca']->staffId; ?>" method="POST" novalidate>

            <div class="form-group">
                <label for="regNo">User Reg:</label>
                <input type="number" name="regNo" id="regNo" value="<?php echo $data['nonaca']->regNo; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" name="fullName" id="fullName" value="<?php echo $data['nonaca']->fullName; ?>" required>
            </div>

            <div class="form-group">
                <label for="nameWithInitial">Name with Initial:</label>
                <input type="text" name="nameWithInitial" id="nameWithInitial" value="<?php echo $data['nonaca']->nameWithInitial; ?>" required>
            </div>

            <div class="form-group">
                <label for="position">Position:</label>
                <input type="text" name="position" id="position" value="<?php echo $data['nonaca']->position; ?>" required>
            </div>


            <div class="form-group">
                <label for="hireDate">Hire Date:</label>
                <input type="date" name="hireDate" id="hireDate" value="<?php echo $data['nonaca']->hireDate; ?>" required>
                <div class="error-message" id="hireDateError"></div>
            </div>

            <button type="submit" class="btn btn-primary">Update Details</button><br><br>
            <a href="<?php echo URLROOT; ?>/Admin/viewNonaca" class="btn btn-secondary">Back to List</a>
        </form>

            <!-- Validation Script -->
            <script>
            document.getElementById('editNonacaForm').addEventListener('submit', function(event) {
                let isValid = true;

                // Clear previous errors
                document.getElementById('formError').style.display = 'none';
                document.getElementById('hireDateError').textContent = '';

                const fullName = document.getElementById('fullName').value.trim();
                const nameWithInitial = document.getElementById('nameWithInitial').value.trim();
                const position = document.getElementById('position').value.trim();
                const department = document.getElementById('department').value.trim();
                const hireDate = document.getElementById('hireDate').value.trim();

                // Validate all fields filled
                if (!fullName || !nameWithInitial || !position || !department || !hireDate) {
                    document.getElementById('formError').style.display = 'block';
                    document.getElementById('formError').textContent = 'Required field is not filled, please check.';
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

        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
