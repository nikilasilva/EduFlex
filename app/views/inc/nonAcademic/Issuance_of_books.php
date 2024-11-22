<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issuance Books</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>
<body>




<div class= "layout">
    <!-- Sidebar -->
    <!-- <?php require APPROOT.'/views/inc/components/sideBar.php'; ?> -->

    <!-- Main content -->
    <div class="container">
        <h1>Issuance Books</h1>

        <div class="search-bar">
            <input type="text" placeholder="Search by name...">
            <button>SEARCH</button>
        </div>

        <!-- Daily Activities form -->
        <form action="<?php echo URLROOT; ?>/NonAcademic/Issuance_books_submit" method="POST">


            <div class="form-group">
                <label for="Student_full_name">Student Full Name :</label>
                <textarea name="Student_full_name" id="Student_full_name" ></textarea>
            </div>        

            <div class="form-group">
                <label for="Student_ID">Student ID :</label>
                <textarea name="Student_ID" id="Student_ID" ></textarea>
            </div>

            <div class="form-group">
                <label for="Name_Of_Book ">Name Of Book :</label>
                <textarea name="Name_Of_Book" id="Name_Of_Book" required></textarea>
            </div>

            <div class="form-group">
                <label for="Book_ID">Book ID</label>
                <textarea name="Book_ID" id="Book_ID" ></textarea>
            </div>

            <div class="form-group">
                <label for="Date_of_issuance">Date of Issuance:</label>
                <input type="date" name="Date_of_issuance" id="Date_of_issuance" required>
            </div>

            <div class="form-group">
                <label for="Date_of_receipt">Date of Receipt:</label>
                <input type="date" name="Date_of_receipt" id="Date_of_receipt" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit Activity</button><br></br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/teacher/viewActivities'" class="btn btn-primary">View All Records</button><br></br>

            <a href="<?php echo URLROOT; ?>/teacher/viewActivities" class="btn btn-secondary">Cancel</a>

            
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>