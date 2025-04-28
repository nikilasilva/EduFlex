<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Non-Academic Staff</title>

   <!-- Link to the CSS file -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
     <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/insert_actor_style.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Insert Non-Academic Staff Details</h1>

       <!-- Error message at the top -->
<div id="formError" class="form-error-message" style="display:none;"></div>

        <form id="nonAcaForm" action="<?php echo URLROOT; ?>/Admin/submitNonaca" method="POST" novalidate>

                <!-- User ID -->
                <div class="form-group">
                    <label for="regNo">User Reg:</label>
                    <input type="number" name="regNo" id="regNo" required>
                </div>

                <!-- Position -->
                <div class="form-group">
                    <label for="position">Position:</label>
                    <input type="text" name="position" id="position" required>
                </div>

                <!-- Department -->
              
                <!-- Hire Date -->
                <div class="form-group">
                    <label for="hireDate">Hire Date:</label>
                    <input type="date" name="hireDate" id="hireDate" required>
                    <div class="error-message" id="hireDateError"></div>
                </div>

                <button type="submit" class="btn btn-primary">Submit Non-Academic</button><br><br>
                <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewNonaca'" class="btn btn-primary">View Non-Academic Staff</button><br><br>
                <a href="<?php echo URLROOT; ?>/Dashboard/index" class="btn btn-secondary">Cancel</a><br><br>

        </form>

        <!-- Validation Script -->
        <script>
        document.getElementById('nonAcaForm').addEventListener('submit', function(event) {
            let isValid = true;
            let formError = document.getElementById('formError');
            formError.style.display = 'none'; // Reset

            // Clear previous hire date error
            document.getElementById('hireDateError').textContent = '';

            const regNo = document.getElementById('regNo').value.trim();
            const position = document.getElementById('position').value.trim();
            const department = document.getElementById('department').value.trim();
            const hireDate = document.getElementById('hireDate').value;

            // Validate all fields
            if (!regNo || !position || !department || !hireDate) {
                formError.style.display = 'block';
                formError.textContent = 'Required field is not filled, please check.';
                isValid = false;
            }

            // Validate hire date
            if (hireDate) {
                const selectedDate = new Date(hireDate);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate > today) {
                    document.getElementById('hireDateError').textContent = 'Hire Date cannot be a future date.';
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

            <!-- ################To get users ID ################ -->

        
                        <h1>Show Non-Academics Details</h1>

                        <!-- Student Accounts Table -->
                        <table class="activities-table">
                            <thead>
                                <tr>
                                    <th>Reg No</th>
                                    <th>Name with Initials</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['users'] as $user): ?>
                                    <?php if ($user->role === 'non-academic'): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($user->regNo); ?></td>
                                            <td><?php echo htmlspecialchars($user->nameWithInitial); ?></td>
                                            <td><?php echo htmlspecialchars($user->email); ?></td>
                                            <td><?php echo htmlspecialchars($user->role); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>



             <!-- ################To get users ID ################ -->

        
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
