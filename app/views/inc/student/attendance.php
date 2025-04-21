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
      <li class="nav-links"><a href="<?php echo URLROOT ?>/ViewAttendance/attendance" class="active"><i class="fa-solid fa-clipboard-user icon"></i><span class="text nav-text">Attendance Details</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Payment_charges/payment"><i class="fa-solid fa-credit-card icon"></i><span class="text nav-text">Payment Details</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/timeTable"><i class="fa-solid fa-table icon"></i><span class="text nav-text">Timetable</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/events"><i class="fa-solid fa-calendar-days icon"></i><span class="text nav-text">Scheduled Events</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/certificate"><i class="fa-solid fa-certificate icon"></i><span class="text nav-text">Certificates</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Student/form"><i class="fa-solid fa-file icon"></i><span class="text nav-text">Charges Form</span></a></li>
      <li class="nav-links"><a href="<?php echo URLROOT ?>/Users/settings"><i class="fa-solid fa-gear icon"></i><span class="text nav-text">Settings</span></a></li>
    </ul>

  </nav>

  <div class="aca-container">
        <h1>Your Attendance Details</h1>

        <!-- Month navigation buttons -->
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

        <div class="month-nav">
            <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>" class="nav-btn">←</a>
            <span class="current-month"><?= $monthName . ' ' . $data['year'] ?></span>
            <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>" class="nav-btn">→</a>
        </div>

        <!-- Display attendance -->
        <?php if (!empty($data['attendance'])) : ?>
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
        <?php else : ?>
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

.nav-btn {
    padding: 5px 10px;
    background-color:rgb(15, 23, 111);
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin: 0 10px;
}

.nav-btn:hover {
    background-color:rgb(15, 23, 111);
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



</style>

<?php require APPROOT.'/views/inc/footer.php'; ?>