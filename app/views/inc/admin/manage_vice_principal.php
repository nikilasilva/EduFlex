<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Vice Principal</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/style.css">
</head>
<body>
<div class="layout">
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>
    <div class="container">
        <h1>Insert Vice Principal Details!!!</h1>

        <form action="<?php echo URLROOT; ?>/Admin/submitVicePrincipal" method="POST">
            <!-- User ID -->
            <div class="form-group">
                <label for="regNo">User Reg:</label>
                <input type="number" name="regNo" id="regNo" value="<?php echo isset($formData['regNo']) ? $formData['regNo'] : ''; ?>" required>
                <span class="error"><?php echo isset($errors['regNo']) ? $errors['regNo'] : ''; ?></span>
            </div>

            <div class="form-group">
                <label for="firstName">First Name :</label>
                <input type="text" name="firstName" id="firstName" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name :</label>
                <input type="text" name="lastName" id="lastName" required>
            </div>

            <!-- Experience -->
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

            <button type="submit" class="btn btn-primary">Submit Vice Principal</button>
            <br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewVicePrincipal'" class="btn btn-primary">View Vice Principals</button>


            <!-- ################To get users ID ################ -->

        
            <h1>Show User Accounts</h1>

            <!-- User Accounts Table -->
            <table class="activities-table">
                <thead>
                    <tr>
                        <th>User Reg</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user->regNo); ?></td>
                            <td><?php echo htmlspecialchars($user->username); ?></td>
                            <td><?php echo htmlspecialchars($user->email); ?></td>

                            <td><?php echo htmlspecialchars($user->role); ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        



             <!-- ################To get users ID ################ -->
        </form>
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
