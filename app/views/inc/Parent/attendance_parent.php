<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <style>
        /* Add some debugging styles */
        .debug-info {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            font-family: monospace;
            white-space: pre-wrap;
        }
        /* Ensure all rows are visible */
        .attendance-table tr {
            display: table-row !important;
        }

        /* Styles for navigation buttons */
        .nav-arrows a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 18px;
            margin: 0 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .nav-arrows span {
            font-weight: bold;
            font-size: 20px;
        }
    </style>
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
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/academic_details"><i class="fa-solid fa-chalkboard-user icon"></i><span class="text nav-text">Academic Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/attendance"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Attendance Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/pay_details"><i class="fa-solid fa-credit-card icon"></i><span class="text nav-text">Payment Details</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/timeTable"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Timetable</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/events"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Scheduled Events</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/charges_form"><i class="fa-solid fa-file icon"></i><span class="text nav-text">Charges Form</span></a></li>
        <li class="nav-links"><a href="<?php echo URLROOT ?>/Parents/feedback"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Feedbacks</span></a></li>
    </ul>
</nav>

<div class="attendance-container-unique">
<h1 id="monthTitle"><?php echo isset($currentMonth) ? $currentMonth : date('F'); ?> Attendance</h1>

<!-- Filter Form -->
<form action="<?php echo URLROOT; ?>/Attendance/index" method="GET" class="filter-form">
  <label for="student_id">Enter Student ID:</label>
  <input type="text" id="student_id" name="student_id" placeholder="Enter Student ID"
         value="<?php echo isset($studentId) ? htmlspecialchars($studentId) : ''; ?>">
  <button type="submit">Filter</button>
  <?php if(isset($studentId)): ?>
    <a href="<?php echo URLROOT; ?>/Attendance/index" class="reset-btn">Reset Filter</a>
  <?php endif; ?>
</form>

<?php if (isset($studentId)): ?>
  <?php
    // Get attendance data
    $studentName = 'Unknown';
    $studentClass = 'Unknown';
    
    // Extract student info if available
    if (!empty($attendanceData)) {
        $studentName = htmlspecialchars($attendanceData[0]->name);
        $studentClass = htmlspecialchars($attendanceData[0]->class);
    }
    
    // Debug the attendance data
    echo '<div class="debug-info" style="display:none;">';
    echo "Student ID: " . htmlspecialchars($studentId) . "\n";
    echo "Student Name: " . $studentName . "\n";
    echo "Student Class: " . $studentClass . "\n";
    echo "Attendance Records: " . count($attendanceData) . "\n\n";
    
    if (!empty($attendanceData)) {
        echo "First Record:\n";
        echo "Date: " . $attendanceData[0]->date . "\n";
        echo "Status: " . $attendanceData[0]->status . "\n\n";
    }
    
    echo "Creating attendance map...\n";
    
    // Create attendance map
    $attendanceMap = [];
    foreach ($attendanceData as $record) {
        $attendanceMap[$record->date] = $record;
        echo "Added record for date: " . $record->date . "\n";
    }
    
    echo '</div>';
  ?>

  <!-- Hard-coded attendance table for April 2025 -->
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
        <?php 
        // Hard-coded approach for April 2025 (30 days)
        $month = 4; // April
        $year = 2025;
        $daysInMonth = 30; // April has 30 days
        
        for ($day = 1; $day <= $daysInMonth; $day++):
            // Format dates in multiple ways to ensure we catch the right format
            $dateYMD = sprintf('%04d-%02d-%02d', $year, $month, $day);
            $dateMDY = sprintf('%02d/%02d/%04d', $month, $day, $year);
            
            // Display date in readable format
            $displayDate = sprintf('%02d Apr %04d', $day, $year);
            
            // Check for attendance in all possible date formats
            $record = null;
            $status = 'Not Marked';
            
            if (isset($attendanceMap[$dateYMD])) {
                $record = $attendanceMap[$dateYMD];
                $status = htmlspecialchars($record->status);
            } elseif (isset($attendanceMap[$dateMDY])) {
                $record = $attendanceMap[$dateMDY];
                $status = htmlspecialchars($record->status);
            }
            
            $rowClass = strtolower($status) === 'absent' ? 'absent-row' : '';
        ?>
          <tr class="<?php echo $rowClass; ?>">
            <td><?php echo $displayDate; ?></td>
            <td><?php echo $studentName; ?></td>
            <td><?php echo $studentClass; ?></td>
            <td>
              <span class="status-badge status-<?php echo strtolower($status); ?>">
                <?php echo $status; ?>
              </span>
            </td>
          </tr>
        <?php endfor; ?>
      </tbody>
    </table>
  </div>

  <!-- Navigation Arrows -->
  <div style="text-align: center; margin: 20px 0; z-index: 100;">
      <a href="<?php echo URLROOT; ?>/Attendance/index?student_id=<?php echo $studentId; ?>&month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>"
         class="nav-arrows">
          &#8592; Previous
      </a>

      <span><?php echo date('F', mktime(0, 0, 0, $month, 1)) . ' ' . $year; ?></span>

      <a href="<?php echo URLROOT; ?>/Attendance/index?student_id=<?php echo $studentId; ?>&month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>"
         class="nav-arrows">
          Next &#8594;
      </a>
  </div>
<?php else: ?>
  <p>Please enter a Student ID to view attendance.</p>
<?php endif; ?>

</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.querySelector('.toggle');
    const sidebar = document.querySelector('.sidebar');
    if (toggleBtn && sidebar) {
      toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('close');
      });
    }
  });
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
