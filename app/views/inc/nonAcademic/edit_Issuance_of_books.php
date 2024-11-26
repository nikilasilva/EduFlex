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
            <h1>Update library activity </h1>



            <!-- Daily Activities form -->
            <form action="<?php echo URLROOT; ?>/NonAcademic/editActivity" method="POST">


                <!-- <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" name="time" id="time" required>
            </div> -->





                <!-- <div class="form-group">
                <label for="student_id">student id :</label>
                <textarea name="student_id" id="student_id" rows="1"></textarea>
            </div>

            

            <div class="form-group">
                <label for="book_id">book_id :</label>
                <textarea name="book_id" id="book_id" rows="1"></textarea>
            </div>

            <div class="form-group">
                <label for="full_name">full_name :</label>
                <textarea name="full_name" id="full_name" rows="1" required></textarea>
            </div>

            <div class="form-group">
                <label for="additional_note">book_name :</label>
                <textarea name="book_name" id="additional_note" rows="1"></textarea>
            </div>

            <div class="form-group">
                <label for="date">issue date:</label>
                <input type="date" name="issue_date" id="date" required>
            </div> -->


                <div class="form-group">
                    <label for="description">book_id:</label>
                    <textarea name="description" id="description" rows="4" required><?php echo htmlspecialchars($data['activity']->book_id); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="additional_note">full_name :</label>
                    <textarea name="additional_note" id="additional_note" rows="4"><?php echo htmlspecialchars($data['activity']->full_name); ?></textarea>
                </div>



                <div class="form-group">
                    <label for="description">book_name:</label>
                    <textarea name="description" id="description" rows="4" required><?php echo htmlspecialchars($data['activity']->book_name); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="additional_note">issue date : </label>
                    <textarea name="additional_note" id="additional_note" rows="4"><?php echo htmlspecialchars($data['activity']->issue_date); ?></textarea>
                </div>




                <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
                <a href="<?php echo URLROOT; ?>/NonAcademic/viewActivities" class="btn btn-secondary">Cancel</a>



            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>