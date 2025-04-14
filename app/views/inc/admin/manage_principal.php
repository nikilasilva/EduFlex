<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Principal</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/style.css">
</head>
<body>
<div class="layout">
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>
    <div class="container">
        <h1>Insert Principal Details</h1>

        <?php
        // Capture the userID from the URL if it's available
        $userID = isset($_GET['userID']) ? htmlspecialchars($_GET['userID']) : '';
        ?>

        <form action="<?php echo URLROOT; ?>/Admin/submitPrincipal" method="POST">
            <!-- User ID -->
            <div class="form-group">
                <label for="userID">User ID:</label>
                <input type="number" name="userID" id="userID" value="<?php echo isset($formData['userID']) ? $formData['userID'] : ''; ?>" required>
                <span class="error"><?php echo isset($errors['userID']) ? $errors['userID'] : ''; ?></span>
            </div>

            <!-- Experience -->
            <div class="form-group">
                <label for="experience">Years of Experience:</label>
                <input type="number" name="experience" id="experience" value="<?php echo isset($formData['experience']) ? $formData['experience'] : ''; ?>" required>
                <span class="error"><?php echo isset($errors['experience']) ? $errors['experience'] : ''; ?></span>
            </div>

            <!-- Hire Date -->
            <div class="form-group">
                <label for="hireDate">Hire Date:</label>
                <input type="date" name="hireDate" id="hireDate" value="<?php echo isset($formData['hireDate']) ? $formData['hireDate'] : ''; ?>" required>
                <span class="error"><?php echo isset($errors['hireDate']) ? $errors['hireDate'] : ''; ?></span>
            </div>

            <button type="submit" class="btn btn-primary">Submit Principal</button>
            <br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewPrincipal'" class="btn btn-primary">View Principals</button>

            <!-- ################To get users ID ################ -->

        
            <h1>Show User Accounts</h1>

            <!-- User Accounts Table -->
            <table class="activities-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['users'] as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user->userID); ?></td>
                            <td><?php echo htmlspecialchars($user->firstName); ?></td>
                            <td><?php echo htmlspecialchars($user->lastName); ?></td>
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
