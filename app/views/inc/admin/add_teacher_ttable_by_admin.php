<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Teacher Time Table</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/insert_actor_style.css">
</head>
<body>
<div class="admin_layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content for manage Student -->
    <div class="manage_actor_container">
        <h1>Insert Teacher Time Table</h1>

        <!-- Insert Student Details Form -->
        <form action="<?php echo URLROOT; ?>/admin/insertStudentDetails" method="POST" class="actor_form">
        <div class="form-row">
                <label for="TeacherId"> Teacher Id:</label>
                <input type="text" name="TeacherId" id="TeacherId" required>
            </div>
            <div class="form-row">
            <label for="1st_period">1st Period:</label>
                <select name="1st_period" id="1st_period" required>
                    <option value="">Select Grade</option>
                    <option value="Grade 6">Grade 6</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                </select>
            </div>     <div class="form-row">
            <label for="2nd_period">2st Period:</label>
                <select name="2nd_period" id="2nd_period" required>
                    <option value="">Select Grade</option>
                    <option value="Grade 6">Grade 6</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                </select>
            </div>
            <div class="form-row">
            <label for="3rd_Period">1st Period:</label>
                <select name="3rd_Period" id="3rd_Period" required>
                    <option value="">Select Grade</option>
                    <option value="Grade 6">Grade 6</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                </select>
            </div>
            <div class="form-row">
            <label for="4th_period">4th Period:</label>
                <select name="4th_period" id="4th_period" required>
                    <option value="">Select Grade</option>
                    <option value="Grade 6">Grade 6</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                </select>
            </div>
            <div class="form-row">
            <label for="5th_period">5th Period:</label>
                <select name="5th_period" id="5th_period" required>
                    <option value="">Select Grade</option>
                    <option value="Grade 6">Grade 6</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                </select>
            </div>
            <div class="form-row">
            <label for="6th_period">6th Period:</label>
                <select name="6th_period" id="6th_period" required>
                    <option value="">Select Grade</option>
                    <option value="Grade 6">Grade 6</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                </select>
            </div>
            <div class="form-row">
            <label for="7th_period">7th Period:</label>
                <select name="7th_period" id="7th_period" required>
                    <option value="">Select Grade</option>
                    <option value="Grade 6">Grade 6</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                </select>
            </div>
            <div class="form-row">
            <label for="8th_period">8th Period:</label>
                <select name="8th_period" id="8th_period" required>
                    <option value="">Select Grade</option>
                    <option value="Grade 6">Grade 6</option>
                    <option value="Grade 7">Grade 7</option>
                    <option value="Grade 8">Grade 8</option>
                    <option value="Grade 9">Grade 9</option>
                    <option value="Grade 10">Grade 10</option>
                    <option value="Grade 11">Grade 11</option>
                </select>
            </div>

          
            
            
            
           
           
            
        
            <div class="form-row">
                <button type="submit" class="submit-button">Insert Time table</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
