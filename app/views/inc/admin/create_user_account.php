<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User Account</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Issue Books</h1>

            <!-- Daily Activities form -->
            <form action="<?php echo URLROOT; ?>/Admin/enterUser" method="POST">



                <div class="form-group">
                    <label for="id">user id :</label>
                    <textarea name="id" id="id" rows="1"></textarea>
                </div>



                <div class="form-group">
                    <label for="username">username :</label>
                    <textarea name="username" id="username" rows="1"></textarea>
                </div>

                <div class="form-group">
                    <label for="email">email :</label>
                    <textarea name="email" id="email" rows="1" required></textarea>
                </div>

                <div class="form-group">
                    <label for="password">password :</label>
                    <textarea name="password" id="password" rows="1"></textarea>
                </div>


                <div class="form-group">
                    <label for="role">role :</label>
                    <select name="role" id="role" required>
                        <option value="">Select Period</option>
                        <option value="1">student</option>
                        <option value="2">admin</option>
                        <option value="3">Period 3</option>
                        <option value="4">Period 4</option>
                        <option value="5">Period 5</option>
                        <option value="6">Period 6</option>
                        <option value="7">Period 7</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Enter New User</button><br></br>
                <!-- <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/teacher/viewActivities'" class="btn btn-primary">View All Records</button><br></br> -->

                <a href="<?php echo URLROOT; ?>/teacher/viewActivities" class="btn btn-secondary">Cancel</a>


            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>