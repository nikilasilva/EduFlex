<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Parent</title>



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
        <h1>Insert Parent Details</h1>

        <!-- Parent details form -->
        <form id="parentForm" action="<?php echo URLROOT; ?>/Admin/submitParent" method="POST" novalidate>

                <div class="form-group">
                    <label for="regNo">User Reg (Parent):</label>
                    <input type="number" name="regNo" id="regNo" required>
                    <div class="error-message" id="regNoError"></div>
                </div>

                <div class="form-group">
                    <label for="NIC">NIC :</label>
                    <input type="text" name="NIC" id="NIC" required>
                    <div class="error-message" id="NICError"></div>
                </div>

                <div class="form-group">
                    <label for="Relationship">Relationship:</label>
                    <select name="Relationship" id="Relationship" required>
                        <option value="">-- Select Relationship --</option>
                        <option value="Mother">Mother</option>
                        <option value="Father">Father</option>
                        <option value="Guardian">Guardian</option>
                    </select>
                    <div class="error-message" id="RelationshipError"></div>
                </div>

                <button type="submit" class="btn btn-primary">Submit Parent</button><br><br>
                <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/Admin/viewParent'" class="btn btn-primary">View All Parents</button><br><br>
                <a href="<?php echo URLROOT; ?>/Dashboard/index" class="btn btn-secondary">Cancel</a>
        </form>

                <script>
                // Client-side Validation
                document.getElementById('parentForm').addEventListener('submit', function(event) {
                let isValid = true;

                // Clear previous errors
                document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

                // regNo Validation
                const regNo = document.getElementById('regNo').value.trim();
                if (!regNo) {
                    document.getElementById('regNoError').textContent = 'Registration number is required.';
                    isValid = false;
                }

                // NIC Validation
                const NIC = document.getElementById('NIC').value.trim();
                if (!NIC || (NIC.length !== 10 && NIC.length !== 12)) {
                    document.getElementById('NICError').textContent = 'Incorrect NIC.';
                    isValid = false;
                }

                // Relationship Validation
                const Relationship = document.getElementById('Relationship').value;
                if (!Relationship) {
                    document.getElementById('RelationshipError').textContent = 'Relationship is required.';
                    isValid = false;
                }

                // If any validation fails, prevent form submission
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
<br><br>

                                        <!-- ################To get users ID ################ -->

                            
                                        <h1>Show Parent Details</h1>

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
                                <?php if ($user->role === 'parent'): ?>
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

<?php require APPROOT . '/views/inc/footer.php'; ?>
