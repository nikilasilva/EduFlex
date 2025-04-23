<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<div class="content-wrapper">
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

  </nav>

  <div class="aca-container">
    <h1>Student Attendance Details</h1>

    <form action="<?=URLROOT?>/ViewAttendance/attendanceParent" method="POST" class="attendance-form" style="margin-bottom: 20px;">
      <label for="student_id">Enter Student ID:</label>
      <input type="text" name="student_id" id="student_id" value="<?= htmlspecialchars($data['studentId'] ?? '') ?>" required>

      <input type="hidden" name="month" value="<?= $data['month'] ?>">
      <input type="hidden" name="year" value="<?= $data['year'] ?>">
      <button type="submit" class="nav-btn">View Attendance</button>
    </form>

    <?php
      
      $prevMonth = $data['month'] - 1;
      $nextMonth = $data['month'] + 1;
      $year = $data['year'];

      if ($prevMonth < 1) {
        $prevMonth = 12;
        $prevYear = $year - 1;
      } else {
        $prevYear = $year;
      }

      if ($nextMonth > 12) {
        $nextMonth = 1;
        $nextYear = $year + 1;
      } else {
        $nextYear = $year;
      }

      $monthName = date("F", mktime(0, 0, 0, $data['month'], 1));
    ?>

    <?php if (!empty($data['studentId'])): ?>
      <div class="month-nav">
        <form method="POST" style="display: inline;">
          <input type="hidden" name="student_id" value="<?= $data['studentId'] ?>">
          <input type="hidden" name="month" value="<?= $prevMonth ?>">
          <input type="hidden" name="year" value="<?= $prevYear ?>">
          <button type="submit" class="nav-btn"> ←  </button>
        </form>

        <span class="current-month"><?= $monthName . ' ' . $data['year'] ?></span>


        <form method="POST" style="display: inline;">
          <input type="hidden" name="student_id" value="<?= $data['studentId'] ?>">
          <input type="hidden" name="month" value="<?= $nextMonth ?>">
          <input type="hidden" name="year" value="<?= $nextYear ?>">
          <button type="submit" class="nav-btn">→</button>
        </form>
      </div>
    <?php endif; ?>

    <?php if (!empty($data['error'])) : ?>
      <p style="color: red;"><?= htmlspecialchars($data['error']) ?></p>
    <?php elseif (!empty($data['attendance'])) : ?>
      <table>
        <thead class="academic-table-header">
          <tr>
            <th class="academic-header-cell">Date</th>
            <th class="academic-header-cell">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['attendance'] as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row->date) ?></td>
              <td><?= htmlspecialchars($row->status) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php elseif (!empty($data['studentId'])) : ?>
      <p>No attendance records found for this month.</p>
    <?php endif; ?>
  </div>
</div>

<style>
  .month-nav {
    display: flex;
    justify-content: center;
    margin: 20px 0;
    font-size: 18px;
  }

  .current-month {
    font-size: 20px;
    font-weight: bold;
    align-self: center;
    margin: 0 20px; /* This adds horizontal space on both sides */
}


  .nav-btn {
    padding: 5px 10px;
    background-color: rgb(15, 23, 111);
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin: 0 10px;
    border: none;
    cursor: pointer;
  }

  .nav-btn:hover {
    background-color: rgb(12, 18, 90);
  }

  .current-month {
    font-size: 20px;
    font-weight: bold;
    align-self: center;
  }

  .academic-header-cell {
    padding: 10px;
    text-align: left;
  }

  .attendance-form input[type="text"] {
    padding: 8px;
    margin-right: 10px;
   
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .attendance-form button {
    padding: 8px 16px;
  }
</style>

<?php require APPROOT . '/views/inc/footer.php'; ?>
