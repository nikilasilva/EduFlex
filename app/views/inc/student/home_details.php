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
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/details"><i class="fa-solid fa-user-graduate icon"></i><span class="text nav-text">Details</span></a></li>
        
            <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/academic"><i class="fa-solid fa-chalkboard-user icon"></i><span class="text nav-text">Academic Details</span></a></li>
            <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/attendance"><i class="fa-solid fa-clipboard-user icon"></i><span class="text nav-text">Attendance Details</span></a></li>
            <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/payment"><i class="fa-solid fa-credit-card icon"></i><span class="text nav-text">Payment Details</span></a></li>

        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/timeTable"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Timetable</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/events"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Scheduled Events</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/certificate"><i class="fa-solid fa-certificate icon"></i><span class="text nav-text">Certificates</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/form"><i class="fa-solid fa-file icon"></i><span class="text nav-text">Charges Form</span></a></li>
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

<div class="profile-card">
    <div class="profile-image">
        <img src="../public/img/Student.jpg" alt="Daniel Grant">
    </div>
    <div class="profile-details">
        <h2>Daniel Grant</h2>
        <p><span>ID Number:</span> 22</p>
        <p><span>Full Name:</span> Daniel Grant Fernando</p>
        <p><span>Gender:</span> Male</p>
        <p><span>Date Of Birth:</span> 07.08.2016</p>
        <p><span>E-mail:</span> danielgrant@gmail.com</p>
        <p><span>Admission Date:</span> 07.08.2019</p>
        <p><span>Class:</span> 2</p>

        <!-- <?php foreach($data['Student'] as $Student): ?>
        <p><strong>ID Number :</strong> <?php echo $Student->student_id; ?></p>
        <p><strong>Full Name :</strong> <?php echo $Student->name; ?></p>
        <p><strong>Gender :</strong> <?php echo $Student->gender; ?></p>
        <p><strong>Date Of Birth :</strong> <?php echo $Student->dob; ?></p>
        <p><strong>E-mail :</strong> <?php echo $Student->email; ?></p>
        <p><strong>Admission Date :</strong> <?php echo $Student->admission_date; ?></p>
        <p><strong>Class :</strong> <?php echo $Student->class; ?></p>
    <?php endforeach; ?> -->


    </div>
</div>

</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>

