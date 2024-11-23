<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Subjects</title>
    
</head>
<body>

<!-- Sidebar -->
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
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/details"><i class="fa-solid fa-user-graduate icon"></i><span class="text nav-text">Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/academic_details"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Academic Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/attendance"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Attendance Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/pay_details"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Payment Details</span></a></li>
        <li class="nav-links"><a href="#timetable"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Timetable</span></a></li>
        <li class="nav-links"><a href="#scheduled events"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Scheduled Events</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/charges_form"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Charges Form</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/feedback"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Feedbacks</span></a></li>
    </ul>
</nav>


<div class="attendance-container-unique">
    <h2 id="monthTitle">January</h2>
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