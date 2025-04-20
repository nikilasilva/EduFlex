<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>

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
        <li class="nav-links"><a href="<?php echo URLROOT ?>/ParentStudent/details"><i class="fa-solid fa-user-graduate icon"></i><span class="text nav-text">Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Academic/academic_details"><i class="fa-solid fa-chalkboard-user icon"></i><span class="text nav-text">Academic Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/ViewAttendance/attendanceParent"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Attendance Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Payment_charges/paymentParent"><i class="fa-solid fa-credit-card icon"></i><span class="text nav-text">Payment Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/timeTable"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Timetable</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/events"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Scheduled Events</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/charges_form"><i class="fa-solid fa-file icon"></i><span class="text nav-text">Charges Form</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/report"><i class="fa-solid fa-comment icon"></i><span class="text nav-text">Report</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Users/settings"><i class="fa-solid fa-gear icon"></i><span class="text nav-text">Settings</span></a></li>
 
    </ul>
</nav>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <style>
        .profile-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin: 40px auto;
            padding: 30px;
            max-width: 700px;
            display: flex;
            gap: 25px;
            align-items: center;
        }
        .profile-image img {
            width: 150px;
            height: 150px;
            border-radius: 12px;
            object-fit: cover;
        }
        .profile-details h2 {
            margin-top: 0;
            margin-bottom: 10px;
            position: relative;
            left: -100px;
            top:-30px;
        }
        .profile-details p {
            margin: 6px 0;
        }
        .profile-details span {
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php if (!empty($data['students'])): ?>
    <?php foreach ($data['students'] as $student): ?>
        <div class="profile-card">
            <div class="profile-image">
                <img src="<?php echo URLROOT ?>/public/img/Student.jpg" alt="Student Photo">
            </div>
            <div class="profile-details">
                <h2><?= htmlspecialchars($student->firstName . ' ' . $student->lastName) ?></h2>
                <p><span>ID Number  :</span> <?= htmlspecialchars($student->regNo) ?></p>
                <p><span>Full Name  :</span> <?= htmlspecialchars($student->firstName . ' ' . $student->lastName) ?></p>
                <p><span>Student ID :</span> <?= htmlspecialchars($student->student_id) ?></p>
                <!-- <p><span>Gender:</span> <?= htmlspecialchars($student->gender) ?></p>
                <p><span>Date Of Birth:</span> <?= htmlspecialchars($student->dob) ?></p>
                <p><span>E-mail:</span> <?= htmlspecialchars($student->email) ?></p>
                <p><span>Admission Date:</span> <?= htmlspecialchars($student->admission_date) ?></p> -->
                <p><span>Class  :</span> <?= htmlspecialchars($student->classId) ?></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div style="text-align: center; margin-top: 100px;">
        <p>No student data found for this parent.</p>
    </div>
<?php endif; ?>

</body>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
