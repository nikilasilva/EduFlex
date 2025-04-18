<?php
// Make sure $payments is available
$payments = $data['payments'] ?? [];
?>

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

  <style>
  .table-container {
    display: flex;
    justify-content: center;
    margin-top: 70px;
    height: 400px;
    width: 70%;
    border-radius: 10px;
    position: relative;
    left: 350px;
    
  }

  table {
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    border-radius: 10px;
    overflow: hidden;
    width: 70%;
    position: relative;
    left:-30px;
    top:-100px;
   
  }

  table th, table td {
    padding: 12px 20px;
    text-align: left;
  }

  table th {
    background-color: #003366;
    color: #fff;
    font-weight: 600;
  }

  table tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  table tr:hover {
    background-color: #e6f0ff;
    transition: 0.3s ease;
  }

  h1 {
    text-align: center;
    margin-top: 40px;
    color: #003366;
  }
</style>



<h1>Payment History</h1>

<?php if (empty($payments)) : ?>
    <p>No payment records found.</p>
<?php else : ?>
    <div class="table-container">
        <table border="1" cellpadding="10">
        <thead>
            <tr>
                <!-- <th>Payment ID</th>
                <th>Full Name</th> -->
                <th>Student ID</th>
                <th>Year of Payment</th>
                <th>Status</th>
                <!-- <th>Payment Slip</th> -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payments as $payment) : ?>
                <tr>
                    <!-- <td><?= htmlspecialchars($payment->payment_id) ?></td>
                    <td><?= htmlspecialchars($payment->full_name) ?></td> -->
                    <td><?= htmlspecialchars($payment->student_id) ?></td>
                    <td><?= htmlspecialchars($payment->year_of_payment) ?></td>
                <!-- <td>
                         <?php if (!empty($payment->payment_slip)) : ?>
                            <a href="<?= URLROOT ?>/uploads/<?= htmlspecialchars($payment->payment_slip) ?>" target="_blank">View</a>
                        <?php else : ?> 
                            No file
                        <?php endif; ?>
                    </td>  -->
                    <td>
                        <span style="color: green; font-weight: bold;">Paid</span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
<?php endif; ?>


<?php require APPROOT . '/views/inc/footer.php'; ?>