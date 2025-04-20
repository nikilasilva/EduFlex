<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Status Table</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/payment.css">
</head>

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

<body>
    <div class="aca-container">
        <h1>Facility & Service Charges</h1>
        
        <form action="<?= URLROOT ?>/payment_charges/paymentParent" method="POST" style="text-align:center; margin-bottom: 30px;">
        <label for="student_id">Enter Student ID:</label>
        <input type="text" name="student_id" id="student_id" value="<?= htmlspecialchars($data['studentId'] ?? '') ?>" required>
        <button type="submit">View Payment Details</button>
    </form>

    <?php if (!empty($data['error'])): ?>
        <p style="color:red; text-align:center;"><?= htmlspecialchars($data['error']) ?></p>
    <?php endif; ?>

    <?php if (!empty($data['payments'])) : ?>
   <table>
        <thead class="academic-table-header">
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
            <?php foreach  ($data['payments'] as $payment) : ?>
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
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($data['error'])) : ?>
            <p style="text-align:center;">No payment records found.</p>
        <?php endif; ?>


    </div>
</body>

<style>
    .table-container {
    margin-top: 20px; /* Adjust space above the table */
}
</style>
</html>

<?php require APPROOT.'/views/inc/footer.php'; ?>
