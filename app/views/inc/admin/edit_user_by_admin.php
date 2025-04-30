<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Account</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
    <style>
        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Update User Account</h1>

            <!-- User Account Edit Form -->
            <form id="editUserForm" action="<?php echo URLROOT; ?>/Admin/editUser/<?php echo $data['users']->regNo; ?>" method="POST" novalidate>

                <div class="form-group">
                    <label for="fullName">Full Name :</label>
                    <input type="text" name="fullName" id="fullName" value="<?php echo htmlspecialchars($data['users']->fullName); ?>" required>
                    <div class="error-message" id="fullNameError"></div>
                </div>

                <div class="form-group">
                    <label for="nameWithInitial">Name With Initials:</label>
                    <input type="text" name="nameWithInitial" id="nameWithInitial" value="<?php echo htmlspecialchars($data['users']->nameWithInitial); ?>" required>
                    <div class="error-message" id="nameWithInitialError"></div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($data['users']->email); ?>" required>
                    <div class="error-message" id="emailError"></div>
                </div>

                <div class="form-group">
                    <label for="mobileNo">Mobile Number:</label>
                    <input type="text" name="mobileNo" id="mobileNo" value="<?php echo htmlspecialchars($data['users']->mobileNo); ?>" required>
                    <div class="error-message" id="mobileNoError"></div>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea name="address" id="address" rows="2" required><?php echo htmlspecialchars($data['users']->address); ?></textarea>
                    <div class="error-message" id="addressError"></div>
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($data['users']->dob); ?>" required>
                    <div class="error-message" id="dobError"></div>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender" required>
                        <option value="Male" <?php if ($data['users']->gender == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if ($data['users']->gender == 'Female') echo 'selected'; ?>>Female</option>
                        <option value="Other" <?php if ($data['users']->gender == 'Other') echo 'selected'; ?>>Other</option>
                    </select>
                    <div class="error-message" id="genderError"></div>
                </div>

                <div class="form-group">
                    <label for="religion">Religion:</label>
                    <input type="text" name="religion" id="religion" value="<?php echo htmlspecialchars($data['users']->religion); ?>" required>
                    <div class="error-message" id="religionError"></div>
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" id="role" required>
                        <option value="admin" <?php if ($data['users']->role == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="teacher" <?php if ($data['users']->role == 'teacher') echo 'selected'; ?>>Teacher</option>
                        <option value="student" <?php if ($data['users']->role == 'student') echo 'selected'; ?>>Student</option>
                        <option value="principal" <?php if ($data['users']->role == 'principal') echo 'selected'; ?>>Principal</option>
                        <option value="vice-principal" <?php if ($data['users']->role == 'vice-principal') echo 'selected'; ?>>Vice Principal</option>
                        <option value="non-academic" <?php if ($data['users']->role == 'non-academic') echo 'selected'; ?>>Non-academic</option>
                        <option value="parent" <?php if ($data['users']->role == 'parent') echo 'selected'; ?>>Parent</option>
                    </select>
                    <div class="error-message" id="roleError"></div>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
                <a href="<?php echo URLROOT; ?>/Admin/viewUser" class="btn btn-secondary">Back to List</a>

            </form>
        </div>
    </div>

    <!-- Validation Script -->
    <script>
        document.getElementById('editUserForm').addEventListener('submit', function(event) {
            let isValid = true;

            // Clear previous error messages
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

            // Full Name
            const fullName = document.getElementById('fullName').value.trim();
            if (!fullName) {
                document.getElementById('fullNameError').textContent = 'Full Name is required.';
                isValid = false;
            }

            // Name With Initials
            const nameWithInitial = document.getElementById('nameWithInitial').value.trim();
            if (!nameWithInitial) {
                document.getElementById('nameWithInitialError').textContent = 'Name with Initials is required.';
                isValid = false;
            }

            // Mobile No
            const mobileNo = document.getElementById('mobileNo').value.trim();
            const mobilePattern = /^\d{10}$/; // 10 digits only
            if (!mobileNo) {
                document.getElementById('mobileNoError').textContent = 'Mobile number is required.';
                isValid = false;
            } else if (!mobilePattern.test(mobileNo)) {
                document.getElementById('mobileNoError').textContent = 'Mobile number must be exactly 10 digits.';
                isValid = false;
            }

            // Address
            const address = document.getElementById('address').value.trim();
            if (!address) {
                document.getElementById('addressError').textContent = 'Address is required.';
                isValid = false;
            }

            // Email
            const email = document.getElementById('email').value.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email || !emailPattern.test(email)) {
                document.getElementById('emailError').textContent = 'Please enter a valid email address.';
                isValid = false;
            }

            // DOB
            const dob = document.getElementById('dob').value;
            if (!dob) {
                document.getElementById('dobError').textContent = 'Date of Birth is required.';
                isValid = false;
            } else {
                const selectedDate = new Date(dob);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate > today) {
                    document.getElementById('dobError').textContent = 'Date of Birth cannot be a future date.';
                    isValid = false;
                }
            }

            // Gender
            const gender = document.getElementById('gender').value;
            if (!gender) {
                document.getElementById('genderError').textContent = 'Please select a gender.';
                isValid = false;
            }

            // Religion
            const religion = document.getElementById('religion').value.trim();
            if (!religion) {
                document.getElementById('religionError').textContent = 'Religion is required.';
                isValid = false;
            }

            // Role
            const role = document.getElementById('role').value;
            if (!role) {
                document.getElementById('roleError').textContent = 'Please select a role.';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>

</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
