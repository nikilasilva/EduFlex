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

    <style>
        .download-button {
            background-color: #007bff;
            /* Blue background */
            color: white;
            /* White text */
            border: none;
            /* Remove borders */
            padding: 10px 20px;
            /* Add padding */
            font-size: 16px;
            /* Increase font size */
            cursor: pointer;
            /* Pointer cursor on hover */
            border-radius: 5px;
            /* Rounded corners */
            text-decoration: none;
            /* Remove underline from links */
            display: inline-block;
            /* Block display for spacing */
        }

        .download-button:hover {
            background-color: #0056b3;
            /* Darker blue on hover */
        }


        /* Style for the search bar */
        .search-bar {
            width: 90%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        /* Add hover focus effect on the search bar */
        .search-bar:focus {
            border-color: #001d3d;
            /* Matches button color */
            outline: none;
        }

        /* Style for the search button */
        .search-button {
            background-color: #001d3d;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Hover effect for the button */
        .search-button:hover {
            background-color: #003566;
        }
    </style>

</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>verify Service Charges</h1>

            <!-- Daily Activities form -->
            <form action="<?php echo URLROOT; ?>/NonAcademic/submitActivities" method="POST">

                <div class="search-container">
                    <input type="text" placeholder="Search..." class="search-bar">
                    <button class="search-button">Search</button>
                </div>




                <div class="form-group">
                    <label for="additional_note">Date of pay :</label>
                    <textarea name="book_name" id="additional_note" rows="1"></textarea>
                </div>



                <!-- this button clas is difine temparry css inthe styls in this page -->
                <a href="path-to-payment-slip.pdf" class="download-button" download>
                    Download Payment Slip PDF
                </a>
                <br><br>

                <label for="html">peyment is successfully</label>
                <input type="radio" id="html" name="fav_language" value="HTML">
                <br><br>
                <label for="css">peyment is not successfully</label>
                <input type="radio" id="css" name="fav_language" value="CSS">


                <button type="submit" class="submit-button">Submit</button>



            </form>
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>