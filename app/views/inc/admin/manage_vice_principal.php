<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Vice Principal</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/style.css">
    <!-- Link to the CSS file -->
   
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/insert_actor_style.css">
</head>
<body>
<div class="layout">
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>
    <div class="container">
        <h1>Insert Vice Principal Details</h1>

        <form id="vicePrincipalForm" action="<?php echo URLROOT; ?>/Admin/submitVicePrincipal" method="POST" novalidate>

                <div class="form-group">
                    <label for="regNo">User Reg:</label>
                    <input type="number" name="regNo" id="regNo" required>
                    <div class="error-message" id="regNoError"></div>
                </div>

                <div class="form-group">
                    <label for="experience">Years of Experience:</label>
                    <input type="number" name="experience" id="experience" min="0" required>
                    <div class="error-message" id="experienceError"></div>
                </div>

                <div class="form-group">
                    <label for="hireDate">Hire Date:</label>
                    <input type="date" name="hireDate" id="hireDate" required>
                    <div class="error-message" id="hireDateError"></div>
                </div>

                <button type="submit" class="btn btn-primary">Submit Vice Principal</button><br><br>
                <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewVicePrincipal'" class="btn btn-primary">View Vice Principals</button><br><br>
                <a href="<?php echo URLROOT; ?>/Dashboard/index" class="btn btn-secondary">Cancel</a><br><br>

        </form>

                <!-- Validation by JS -->
                <script>
                document.getElementById('vicePrincipalForm').addEventListener('submit', function(event) {
                let isValid = true;

                // Clear previous error messages
                document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

                // regNo Validation
                const regNo = document.getElementById('regNo').value.trim();
                if (!regNo) {
                    document.getElementById('regNoError').textContent = 'Registration number is required.';
                    isValid = false;
                }

                // Experience Validation
                const experience = document.getElementById('experience').value.trim();
                if (experience === '' || experience < 0) {
                    document.getElementById('experienceError').textContent = 'Experience must be a positive number.';
                    isValid = false;
                }

                // Hire Date Validation
                const hireDate = document.getElementById('hireDate').value;
                if (!hireDate) {
                    document.getElementById('hireDateError').textContent = 'Hire date is required.';
                    isValid = false;
                } else {
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
                .error-message {
                color: red;
                font-size: 0.9rem;
                margin-top: 5px;
                }
                </style>



            <!-- ################To get users ID ################ -->

        
            <h1>Show Vice Principal Accounts</h1>

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
                        <?php if ($user->role === 'vice-principal'): ?>
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

<style>
    .error {
        color: red;
        font-size: 14px;
        display: block;
        margin-top: 5px;
    }
</style>

</body>
</html>
<?php require APPROOT.'/views/inc/footer.php'; ?>
