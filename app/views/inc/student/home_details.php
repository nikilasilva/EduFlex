<nav class="sidebar">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="<?php echo URLROOT; ?>/public/img/logo_noBG1.png" alt="Logo">
            </span>
            <div class="text header-text">
                <span class="name">EduFlex</span>
            </div>
            <i class="fa-solid fa-bars toggle"></i>
        </div>
    </header>

    <ul>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Dashboard/index"><i class="fa-solid fa-house icon"></i><span class="text nav-text">Home</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Users/details"><i class="fa-solid fa-user-graduate icon"></i><span class="text nav-text">Details</span></a></li>
        
            <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/academic"><i class="fa-solid fa-chalkboard-user icon"></i><span class="text nav-text">Academic Details</span></a></li>
            <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/attendance"><i class="fa-solid fa-clipboard-user icon"></i><span class="text nav-text">Attendance Details</span></a></li>
            <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/payment"><i class="fa-solid fa-credit-card icon"></i><span class="text nav-text">Payment Details</span></a></li>

        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/timeTable"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Timetable</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/events"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Scheduled Events</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/certificate"><i class="fa-solid fa-certificate icon"></i><span class="text nav-text">Certificates</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/form"><i class="fa-solid fa-file icon"></i><span class="text nav-text">Charges Form</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Users/settings"><i class="fa-solid fa-gear icon"></i><span class="text nav-text">Settings</span></a></li>
    </ul>
</nav>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
   
</head>
<body>

<div class="profile-container">
   <!-- <div class="user-profile-header">
      
    </div> -->
    <div class="profile-card">
        <div class="user-profile-image">
            <img src="<?php echo URLROOT; ?>/public/img/profileImg.png" alt="User Photo" class="user-profile-photos">
        </div>
        <div class="user-profile-info-section">
            <div class="user-profile-header">
                <h2 class="user-name"> <?php echo htmlspecialchars(ucwords($data['user']->username)); ?> </h2>
            </div>
            <ul class="user-details">
                <li><strong>ID No:</strong> <?php echo htmlspecialchars($data['user']->regNo); ?> </li>
                <li><strong>Date of Birth:</strong> <?php echo htmlspecialchars($data['user']->dob); ?> </li> 
                <li><strong>Email:</strong> <?php echo htmlspecialchars($data['user']->email); ?> </li>
                <li><strong>Phone No:</strong> <?php echo htmlspecialchars($data['user']->mobileNo); ?> </li>
            </ul>
        </div>
    </div> 
</div>

</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>




