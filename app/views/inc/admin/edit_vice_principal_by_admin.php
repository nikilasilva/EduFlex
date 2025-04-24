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
            <h1>Update Vice Principal Details </h1>



            <!-- Daily Activities form -->
            <!-- <form action="<?php echo URLROOT; ?>/NonAcademic/editActivity" method="POST"> -->
            <form action="<?php echo URLROOT; ?>/Admin/editVicePrincipal/<?php echo $data['vicePrincipal']->vicePrincipalId; ?>" method="POST">


              <!-- User ID -->
             <div class="form-group">
                <label for="regNo">Principal Reg No :</label>
                <input type="number" name="regNo" id="regNo" value="<?php echo htmlspecialchars($data['vicePrincipal']->regNo); ?>" required>



                <span class="error"><?php echo isset($errors['regNo']) ? $errors['regNo'] : ''; ?></span>
            </div>

                                            <!-- Full Name -->
                                <div class="form-group">
                                    <label for="fullName">Full Name:</label>
                                    <input type="text" name="fullName" id="fullName" value="<?php echo htmlspecialchars($data['user']->fullName); ?>" required>
                                </div>

                                <!-- Name with Initial -->
                                <div class="form-group">
                                    <label for="nameWithInitial">Name with Initial:</label>
                                    <input type="text" name="nameWithInitial" id="nameWithInitial" value="<?php echo htmlspecialchars($data['user']->nameWithInitial); ?>" required>
                                </div>


            <!-- Experience -->
            <div class="form-group">
                <label for="experience">Years of Experience:</label>
                <input type="number" name="experience" id="experience" value="<?php echo htmlspecialchars($data['vicePrincipal']->experience) ; ?>" required>
                <span class="error"><?php echo isset($errors['experience']) ? $errors['experience'] : ''; ?></span>
            </div>

            <!-- Hire Date -->
            <div class="form-group">
                <label for="hireDate">Hire Date:</label>
                <input type="date" name="hireDate" id="hireDate" value="<?php echo htmlspecialchars($data['vicePrincipal']->hireDate) ; ?>" required>
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