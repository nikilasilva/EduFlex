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

            <button type="submit" class="btn btn-primary">Submit Vice Principal</button>
            <br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/admin/viewVicePrincipal'" class="btn btn-primary">View Vice Principals</button>
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
