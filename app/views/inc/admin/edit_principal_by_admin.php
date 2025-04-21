<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Books</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Update Principal Details </h1>



            <!-- Daily Activities form -->
            <!-- <form action="<?php echo URLROOT; ?>/NonAcademic/editActivity" method="POST"> -->
            <form action="<?php echo URLROOT; ?>/Admin/editPrincipal/<?php echo $data['principal']->principalId; ?>" method="POST">


              <!-- User ID -->
              <div class="form-group">
                <label for="regNo">Principal ID:</label>
                <input type="number" name="regNo" id="regNo" value="<?php echo htmlspecialchars($data['principal']->principalId) ; ?>" required>
                <span class="error"><?php echo isset($errors['regNo']) ? $errors['regNo'] : ''; ?></span>
            </div>
<!-- First Name -->
            <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" id="firstName" value="<?php echo htmlspecialchars($data['principal']->firstName); ?>" required>
                </div>
<!-- Last Name -->
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" id="lastName" value="<?php echo htmlspecialchars($data['principal']->lastName); ?>" required>
                </div>

            <!-- Experience -->
            <div class="form-group">
                <label for="experience">Years of Experience:</label>
                <input type="number" name="experience" id="experience" value="<?php echo htmlspecialchars($data['principal']->experience) ; ?>" required>
                <span class="error"><?php echo isset($errors['experience']) ? $errors['experience'] : ''; ?></span>
            </div>

            <!-- Hire Date -->
            <div class="form-group">
                <label for="hireDate">Hire Date:</label>
                <input type="date" name="hireDate" id="hireDate" value="<?php echo htmlspecialchars($data['principal']->hireDate) ; ?>" required>
                <span class="error"><?php echo isset($errors['hireDate']) ? $errors['hireDate'] : ''; ?></span>
            </div>







            <!-- <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($data['user']->dob); ?>" required>
                </div> -->


                <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
                <a href="<?php echo URLROOT; ?>/Admin/viewPrincipal" class="btn btn-secondary">Cancel</a>



            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>