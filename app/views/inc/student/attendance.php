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
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Users/details"><i class="fa-solid fa-user-graduate icon"></i><span class="text nav-text">Details</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Academic/academic"><i class="fa-solid fa-chalkboard-user icon"></i><span class="text nav-text">Academic Details</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/attendance" class="active"><i class="fa-solid fa-clipboard-user icon"></i><span class="text nav-text">Attendance Details</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Payment_charges/payment"><i class="fa-solid fa-credit-card icon"></i><span class="text nav-text">Payment Details</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/timeTable"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Timetable</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/events"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Scheduled Events</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/certificate"><i class="fa-solid fa-certificate icon"></i><span class="text nav-text">Certificates</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/form"><i class="fa-solid fa-file icon"></i><span class="text nav-text">Charges Form</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Users/settings"><i class="fa-solid fa-gear icon"></i><span class="text nav-text">Settings</span></a></li>
    </ul>

  </nav>

  <div class="attendance-container-unique">
    <h1 id="monthTitle"><?php echo isset($currentMonth) ? $currentMonth : date('F'); ?> Attendance</h1>
    
    <!-- Filter Form for Student Attendance -->
    <form action="<?php echo URLROOT; ?>/Attendance/index" method="GET" class="filter-form">
      <label for="student_id">Enter Student ID:</label>
      <input type="text" id="student_id" name="student_id" placeholder="Enter Student ID" 
             value="<?php echo isset($studentId) ? htmlspecialchars($studentId) : ''; ?>">
      <button type="submit">Filter</button>
      <?php if(isset($student_id)): ?>
        <a href="<?php echo URLROOT; ?>/Student/attendance" class="reset-btn">Reset Filter</a>
      <?php endif; ?>
    </form>
    
    <?php if (isset($attendanceData) && count($attendanceData) > 0): ?>
      <!-- Display Attendance Table if data exists -->
      <div class="table-container">
        <table class="attendance-table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Student Name</th>
              <th>Class</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($attendanceData as $attendance): ?>
              <tr class="<?php echo strtolower($attendance->status) === 'absent' ? 'absent-row' : ''; ?>">
                <td><?php echo htmlspecialchars(date('d M Y', strtotime($attendance->date))); ?></td>
                <td><?php echo htmlspecialchars($attendance->name); ?></td>
                <td><?php echo htmlspecialchars($attendance->class); ?></td>
                <td>
                  <span class="status-badge status-<?php echo strtolower($attendance->status); ?>">
                    <?php echo htmlspecialchars($attendance->status); ?>
                  </span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <!-- Display message if no records found -->
      <div class="no-data-message">
        <?php if(isset($studentId)): ?>
          <p>No attendance records found for student ID: <?php echo htmlspecialchars($student_id); ?></p>
        <?php else: ?>
          <p>No attendance records found.</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Add toggle functionality for sidebar if needed
    const toggleBtn = document.querySelector('.toggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (toggleBtn && sidebar) {
      toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('close');
      });
    }
  });
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>