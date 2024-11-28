<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Time Table</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/insert_actor_style.css">
</head>
<body>
<div class="admin_layout">
    <!-- Sidebar -->
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

    <!-- Main content for manage Student -->
    <div class="manage_actor_container">
        <h1>Insert Academic Time Table</h1>

        <!-- Insert Student Details Form -->
        <form action="<?php echo URLROOT; ?>/admin/insertStudentDetails" method="POST" class="actor_form">
            <div class="form-row">
            <label for="class">Class:</label>
                <select name="class" id="class" required>
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
            <label for="class">Fist section:</label>
                <select name="class" id="class" required>
                    <option value="">Select Subject</option>
                    <option value="Subject 01">Subject01</option>
                    <option value="Subject 02">Subject 02</option>
                    <option value="Subject 03">Subject 03</option>
                    <option value="Subject 04">Subject 04</option>
                    <option value="Subject 05">Subject 05</option>
                    <option value="Subject 06">Subject 06</option>
                    <option value="Subject 07">Subject 07</option>
                    <option value="Subject 08">Subject 08</option>
                    <option value="Subject 09">Subject 09</option>
                    <option value="Subject 10">Subject 10</option>
                    <option value="Subject 11">Subject 11</option>
                    <option value="Subject 12">Subject 12</option>
                    <option value="Subject 13">Subject 13</option>
                    <option value="Subject 14">Subject 14</option>
                    <option value="Subject 15">Subject 15</option>
                    <option value="Subject 16">Subject 16</option>
                    <option value="Subject 17">Subject 17</option>
                    <option value="Subject 18">Subject 18</option>
                    <option value="Subject 19">Subject 19</option>
                    <option value="Subject 20">Subject 20</option>
                    
                </select>
            </div>

            <div class="form-row">
            <label for="class">2nd section:</label>
                <select name="class" id="class" required>
                    <option value="">Select Subject</option>
                    <option value="Subject 01">Subject01</option>
                    <option value="Subject 02">Subject 02</option>
                    <option value="Subject 03">Subject 03</option>
                    <option value="Subject 04">Subject 04</option>
                    <option value="Subject 05">Subject 05</option>
                    <option value="Subject 06">Subject 06</option>
                    <option value="Subject 07">Subject 07</option>
                    <option value="Subject 08">Subject 08</option>
                    <option value="Subject 09">Subject 09</option>
                    <option value="Subject 10">Subject 10</option>
                    <option value="Subject 11">Subject 11</option>
                    <option value="Subject 12">Subject 12</option>
                    <option value="Subject 13">Subject 13</option>
                    <option value="Subject 14">Subject 14</option>
                    <option value="Subject 15">Subject 15</option>
                    <option value="Subject 16">Subject 16</option>
                    <option value="Subject 17">Subject 17</option>
                    <option value="Subject 18">Subject 18</option>
                    <option value="Subject 19">Subject 19</option>
                    <option value="Subject 20">Subject 20</option>
                    
                </select>
            </div>

            <div class="form-row">
            <label for="class">3rd section:</label>
                <select name="class" id="class" required>
                    <option value="">Select Subject</option>
                    <option value="Subject 01">Subject01</option>
                    <option value="Subject 02">Subject 02</option>
                    <option value="Subject 03">Subject 03</option>
                    <option value="Subject 04">Subject 04</option>
                    <option value="Subject 05">Subject 05</option>
                    <option value="Subject 06">Subject 06</option>
                    <option value="Subject 07">Subject 07</option>
                    <option value="Subject 08">Subject 08</option>
                    <option value="Subject 09">Subject 09</option>
                    <option value="Subject 10">Subject 10</option>
                    <option value="Subject 11">Subject 11</option>
                    <option value="Subject 12">Subject 12</option>
                    <option value="Subject 13">Subject 13</option>
                    <option value="Subject 14">Subject 14</option>
                    <option value="Subject 15">Subject 15</option>
                    <option value="Subject 16">Subject 16</option>
                    <option value="Subject 17">Subject 17</option>
                    <option value="Subject 18">Subject 18</option>
                    <option value="Subject 19">Subject 19</option>
                    <option value="Subject 20">Subject 20</option>
                    
                </select>
            </div>
            <div class="form-row">
            <label for="class">4th section:</label>
                <select name="class" id="class" required>
                    <option value="">Select Subject</option>
                    <option value="Subject 01">Subject01</option>
                    <option value="Subject 02">Subject 02</option>
                    <option value="Subject 03">Subject 03</option>
                    <option value="Subject 04">Subject 04</option>
                    <option value="Subject 05">Subject 05</option>
                    <option value="Subject 06">Subject 06</option>
                    <option value="Subject 07">Subject 07</option>
                    <option value="Subject 08">Subject 08</option>
                    <option value="Subject 09">Subject 09</option>
                    <option value="Subject 10">Subject 10</option>
                    <option value="Subject 11">Subject 11</option>
                    <option value="Subject 12">Subject 12</option>
                    <option value="Subject 13">Subject 13</option>
                    <option value="Subject 14">Subject 14</option>
                    <option value="Subject 15">Subject 15</option>
                    <option value="Subject 16">Subject 16</option>
                    <option value="Subject 17">Subject 17</option>
                    <option value="Subject 18">Subject 18</option>
                    <option value="Subject 19">Subject 19</option>
                    <option value="Subject 20">Subject 20</option>
                    
                </select>
            </div>

            <div class="form-row">
            <label for="class">5th section:</label>
                <select name="class" id="class" required>
                    <option value="">Select Subject</option>
                    <option value="Subject 01">Subject01</option>
                    <option value="Subject 02">Subject 02</option>
                    <option value="Subject 03">Subject 03</option>
                    <option value="Subject 04">Subject 04</option>
                    <option value="Subject 05">Subject 05</option>
                    <option value="Subject 06">Subject 06</option>
                    <option value="Subject 07">Subject 07</option>
                    <option value="Subject 08">Subject 08</option>
                    <option value="Subject 09">Subject 09</option>
                    <option value="Subject 10">Subject 10</option>
                    <option value="Subject 11">Subject 11</option>
                    <option value="Subject 12">Subject 12</option>
                    <option value="Subject 13">Subject 13</option>
                    <option value="Subject 14">Subject 14</option>
                    <option value="Subject 15">Subject 15</option>
                    <option value="Subject 16">Subject 16</option>
                    <option value="Subject 17">Subject 17</option>
                    <option value="Subject 18">Subject 18</option>
                    <option value="Subject 19">Subject 19</option>
                    <option value="Subject 20">Subject 20</option>
                    
                </select>
            </div>
            <div class="form-row">
            <label for="class">6th section:</label>
                <select name="class" id="class" required>
                    <option value="">Select Subject</option>
                    <option value="Subject 01">Subject01</option>
                    <option value="Subject 02">Subject 02</option>
                    <option value="Subject 03">Subject 03</option>
                    <option value="Subject 04">Subject 04</option>
                    <option value="Subject 05">Subject 05</option>
                    <option value="Subject 06">Subject 06</option>
                    <option value="Subject 07">Subject 07</option>
                    <option value="Subject 08">Subject 08</option>
                    <option value="Subject 09">Subject 09</option>
                    <option value="Subject 10">Subject 10</option>
                    <option value="Subject 11">Subject 11</option>
                    <option value="Subject 12">Subject 12</option>
                    <option value="Subject 13">Subject 13</option>
                    <option value="Subject 14">Subject 14</option>
                    <option value="Subject 15">Subject 15</option>
                    <option value="Subject 16">Subject 16</option>
                    <option value="Subject 17">Subject 17</option>
                    <option value="Subject 18">Subject 18</option>
                    <option value="Subject 19">Subject 19</option>
                    <option value="Subject 20">Subject 20</option>
                    
                </select>
            </div>
            <div class="form-row">
            <label for="class">7th Section:</label>
                <select name="class" id="class" required>
                    <option value="">Select Subject</option>
                    <option value="Subject 01">Subject01</option>
                    <option value="Subject 02">Subject 02</option>
                    <option value="Subject 03">Subject 03</option>
                    <option value="Subject 04">Subject 04</option>
                    <option value="Subject 05">Subject 05</option>
                    <option value="Subject 06">Subject 06</option>
                    <option value="Subject 07">Subject 07</option>
                    <option value="Subject 08">Subject 08</option>
                    <option value="Subject 09">Subject 09</option>
                    <option value="Subject 10">Subject 10</option>
                    <option value="Subject 11">Subject 11</option>
                    <option value="Subject 12">Subject 12</option>
                    <option value="Subject 13">Subject 13</option>
                    <option value="Subject 14">Subject 14</option>
                    <option value="Subject 15">Subject 15</option>
                    <option value="Subject 16">Subject 16</option>
                    <option value="Subject 17">Subject 17</option>
                    <option value="Subject 18">Subject 18</option>
                    <option value="Subject 19">Subject 19</option>
                    <option value="Subject 20">Subject 20</option>
                    
                </select>
            </div>
            <div class="form-row">
            <label for="class">8th section:</label>
                <select name="class" id="class" required>
                    <option value="">Select Subject</option>
                    <option value="Subject 01">Subject01</option>
                    <option value="Subject 02">Subject 02</option>
                    <option value="Subject 03">Subject 03</option>
                    <option value="Subject 04">Subject 04</option>
                    <option value="Subject 05">Subject 05</option>
                    <option value="Subject 06">Subject 06</option>
                    <option value="Subject 07">Subject 07</option>
                    <option value="Subject 08">Subject 08</option>
                    <option value="Subject 09">Subject 09</option>
                    <option value="Subject 10">Subject 10</option>
                    <option value="Subject 11">Subject 11</option>
                    <option value="Subject 12">Subject 12</option>
                    <option value="Subject 13">Subject 13</option>
                    <option value="Subject 14">Subject 14</option>
                    <option value="Subject 15">Subject 15</option>
                    <option value="Subject 16">Subject 16</option>
                    <option value="Subject 17">Subject 17</option>
                    <option value="Subject 18">Subject 18</option>
                    <option value="Subject 19">Subject 19</option>
                    <option value="Subject 20">Subject 20</option>
                    
                </select>
            </div>

            <div class="form-row">
            <label for="class">9th section:</label>
                <select name="class" id="class" required>
                    <option value="">Select Subject</option>
                    <option value="Subject 01">Subject01</option>
                    <option value="Subject 02">Subject 02</option>
                    <option value="Subject 03">Subject 03</option>
                    <option value="Subject 04">Subject 04</option>
                    <option value="Subject 05">Subject 05</option>
                    <option value="Subject 06">Subject 06</option>
                    <option value="Subject 07">Subject 07</option>
                    <option value="Subject 08">Subject 08</option>
                    <option value="Subject 09">Subject 09</option>
                    <option value="Subject 10">Subject 10</option>
                    <option value="Subject 11">Subject 11</option>
                    <option value="Subject 12">Subject 12</option>
                    <option value="Subject 13">Subject 13</option>
                    <option value="Subject 14">Subject 14</option>
                    <option value="Subject 15">Subject 15</option>
                    <option value="Subject 16">Subject 16</option>
                    <option value="Subject 17">Subject 17</option>
                    <option value="Subject 18">Subject 18</option>
                    <option value="Subject 19">Subject 19</option>
                    <option value="Subject 20">Subject 20</option>
                    
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
