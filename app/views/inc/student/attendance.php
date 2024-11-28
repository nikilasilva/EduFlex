<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Attendance Grid</title>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/attendance.css">
</head>
<body>
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

  <div class="attendance-container-unique">
    <h1 id="monthTitle">January</h1>
    <table class="attendance-table">
      <thead>
        <tr>
          <th>Week</th>
          <th>Monday</th>
          <th>Tuesday</th>
          <th>Wednesday</th>
          <th>Thursday</th>
          <th>Friday</th>
        </tr>
      </thead>
      <tbody id="attendanceData">
        <tr>
          <td>Week 1</td>
          <td class="attendance-present">&#x2713;</td>
          <td class="attendance-absent">&#x2717;</td>
          <td class="attendance-present">&#x2713;</td>
          <td class="attendance-absent">&#x2717;</td>
          <td class="attendance-present">&#x2713;</td>
        </tr>
        <tr>
          <td>Week 2</td>
          <td class="attendance-absent">&#x2717;</td>
          <td class="attendance-present">&#x2713;</td>
          <td class="attendance-absent">&#x2717;</td>
          <td class="attendance-present">&#x2713;</td>
          <td class="attendance-absent">&#x2717;</td>
        </tr>
        <tr>
          <td>Week 3</td>
          <td class="attendance-present">&#x2713;</td>
          <td class="attendance-present">&#x2713;</td>
          <td class="attendance-absent">&#x2717;</td>
          <td class="attendance-present">&#x2713;</td>
          <td class="attendance-absent">&#x2717;</td>
        </tr>
        <tr>
          <td>Week 4</td>
          <td class="attendance-absent">&#x2717;</td>
          <td class="attendance-present">&#x2713;</td>
          <td class="attendance-present">&#x2713;</td>
          <td class="attendance-absent">&#x2717;</td>
          <td class="attendance-present">&#x2713;</td>
        </tr>
      </tbody>
    </table>
    <div class="attendance-month-navigation">
      <button id="nextMonth" onclick="changeMonth('next')">
        <i class="fa-solid fa-chevron-right"></i>
      </button>
    </div>
  </div>

  <?php require APPROOT . '/views/inc/footer.php'; ?>
  <script src="<?php echo URLROOT; ?>/public/js/attendance.js"></script>
</body>
</html>
