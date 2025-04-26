<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Non-Academic Staff</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <h1>Insert Non-Academic Staff Details</h1>

        <form action="<?php echo URLROOT; ?>/Admin/submitNonaca" method="POST">
            
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
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" name="department" id="department" required>
            </div>

            <!-- Hire Date -->
            <div class="form-group">
                <label for="hireDate">Hire Date:</label>
                <input type="date" name="hireDate" id="hireDate" required>

                        <!-- JavaScript validation -->
                        <script>
                            document.getElementById('hireDate').addEventListener('change', function () {
                                const selectedDate = new Date(this.value);
                                const today = new Date();

                                // Remove time from today's date for accurate comparison
                                today.setHours(0, 0, 0, 0);

                                if (selectedDate > today) {
                                    alert("Hire Date cannot be in the future.");
                                    this.value = '';
                                }
                            });
                        </script>

            </div>

            <button type="submit" class="btn btn-primary">Submit Non-Academic</button><br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewNonaca'" class="btn btn-primary">View Non-Academic Staff</button><br><br>
            <a href="<?php echo URLROOT; ?>/Dashboard/index" class="btn btn-secondary">Cancel</a><br><br>


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

        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
