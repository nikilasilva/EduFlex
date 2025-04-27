<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Teacher Details</title>

   <!-- Link to the CSS file -->
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/insert_actor_style.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Insert Teacher Details</h1>

        <form id="teacherForm" action="<?php echo URLROOT; ?>/Admin/submitTeacher" method="POST" novalidate>

                <div class="form-group">
                    <label for="regNo">User Reg:</label>
                    <input type="number" name="regNo" id="regNo" required>
                    <div class="error-message" id="regNoError"></div>
                </div>

                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <select name="subject" id="subject" required>
                        <option value="">Select Subject</option>
                        <?php foreach($data['subjects'] as $subject): ?>
                            <option value="<?php echo htmlspecialchars($subject->subjectId); ?>">
                                <?php echo htmlspecialchars($subject->subjectName); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="error-message" id="subjectError"></div>
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

                <button type="submit" class="btn btn-primary">Submit Teacher</button><br><br>
                <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewTeacher'" class="btn btn-primary">View Teachers</button><br><br>
                <a href="<?php echo URLROOT; ?>/Dashboard/index" class="btn btn-secondary">Cancel</a><br><br>

        </form>

                        <!-- Validation Script -->
                    <script>
                        document.getElementById('teacherForm').addEventListener('submit', function(event) {
                            let isValid = true;

                            // Clear previous error messages
                            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

                            // regNo validation
                            const regNo = document.getElementById('regNo').value.trim();
                            if (!regNo) {
                                document.getElementById('regNoError').textContent = 'Registration number is required.';
                                isValid = false;
                            }

                            // Subject validation
                            const subject = document.getElementById('subject').value.trim();
                            if (!subject) {
                                document.getElementById('subjectError').textContent = 'Subject is required.';
                                isValid = false;
                            }

                            // Experience validation
                            const experience = document.getElementById('experience').value.trim();
                            if (experience === '' || experience < 0) {
                                document.getElementById('experienceError').textContent = 'Experience must be a positive number.';
                                isValid = false;
                            }

                            // Hire date validation
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

        
            <h1>Show Teachers Details</h1>

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
                        <?php if ($user->role === 'teacher'): ?>
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
