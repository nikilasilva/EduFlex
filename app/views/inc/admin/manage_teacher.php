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

        <form action="<?php echo URLROOT; ?>/Admin/submitTeacher" method="POST">


        <!-- <div class="form-group">
                <label for="teacher_id">Teacher Id :</label>
                <input type="text" name="teacher_id" id="teacher_id" required>
            </div> -->
            
            <div class="form-group">
                <label for="regNo">User Reg:</label>
                <input type="number" name="regNo" id="regNo" required>
            </div>

            <div class="form-group">
                <label for="subject">subject:</label>
                <input type="text" name="subject" id="subject" required>
            </div>

                        <!-- Experience -->
            <div class="form-group">
                <label for="experience">Years of Experience:</label>
                <input type="number" name="experience" id="experience" min="0" value="<?php echo isset($formData['experience']) ? $formData['experience'] : ''; ?>" required>
                <span class="error"><?php echo isset($errors['experience']) ? $errors['experience'] : ''; ?></span>



                <!--JS -->
                        <script>
                            document.getElementById('experience').addEventListener('input', function () {
                                if (this.value < 0) {
                                    this.value = '';
                                    alert("Experience must be a positive number.");
                                }
                            });
                        </script>
            </div>


          <!-- Hire Date -->
<div class="form-group">
    <label for="hireDate">Hire Date:</label>
    <input type="date" name="hireDate" id="hireDate" value="<?php echo isset($formData['hireDate']) ? $formData['hireDate'] : ''; ?>" required>
    <span class="error"><?php echo isset($errors['hireDate']) ? $errors['hireDate'] : ''; ?></span>
</div>

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

            <button type="submit" class="btn btn-primary">Submit Teacher</button><br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewTeacher'" class="btn btn-primary">View Teachers</button><br><br>

            <a href="<?php echo URLROOT; ?>/Dashboard/index" class="btn btn-secondary">Cancel</a><br><br>
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

        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
