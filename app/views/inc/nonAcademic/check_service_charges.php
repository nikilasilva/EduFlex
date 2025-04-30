<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Service Charges</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/attendance.css">
    <!-- <style>
        .change-date {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .change-date input[type="date"] {
            padding: 6px 10px;
            font-size: 16px;
        }

        .change-date button {
            padding: 6px 15px;
            font-size: 16px;
            background-color: #2c7be5;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .change-date button:hover {
            background-color: #1a5bb8;
        }

        .submit-btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: darkgreen;
        }
    </style> -->
</head>

<body>
    <div class="layout">
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>
        <?php if (!empty($_SESSION['success_message'])): ?>
            <div style="color: green; margin-bottom: 20px;">
                <?php
                echo $_SESSION['success_message'];
                unset($_SESSION['success_message']);
                ?>
            </div>
        <?php endif; ?>

        <div class="attendance-container">
            <h1>Download Service Charges - Student Payments Slip</h1>

            <div class="change-date">
                <form method="post" action="<?php echo URLROOT; ?>/NonAcademic/searchServiceChargesByStudentId">
                    <input type="text" name="student_id" placeholder="Enter Student ID" required>
                    <button type="submit">Search</button>
                </form>
            </div>

            <?php if (!empty($_SESSION['error_message'])): ?>
                <div style="color: red; margin-bottom: 20px;">
                    <?php
                    echo $_SESSION['error_message'];
                    unset($_SESSION['error_message']);
                    ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?php echo URLROOT; ?>/NonAcademic/SubmitServiceCharges" enctype="multipart/form-data">
                <table border="1" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Payment Slip</th>
                            <th>Download</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($data['serviceCharges'])): ?>
                            <?php foreach ($data['serviceCharges'] as $student): ?>
                                <?php if ($student->status == 'not status'): // Only show if not yet marked 
                                ?>
                                    <tr>
                                        <td><?php echo $student->student_id; ?></td>
                                        <td><?php echo $student->full_name; ?></td>
                                        <td><?php echo $student->payment_slip; ?></td>
                                        <td>
                                            <?php if (!empty($student->payment_slip)): ?>
                                                <a href="<?php echo URLROOT . '/NonAcademic/downloadFile/' . $student->payment_slip; ?>" target="_self" style="text-decoration: none; padding: 6px 15px; font-size: 16px; background-color: #2c7be5; color: white; border: none; border-radius: 4px; cursor: pointer;">
                                                    Download
                                                </a>
                                            <?php else: ?>
                                                <span>No file</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 15px;">
                                                <label>
                                                    <input type="radio" name="attendance[<?php echo $student->student_id; ?>]" value="successful" required> Successful
                                                </label>
                                                <label>
                                                    <input type="radio" name="attendance[<?php echo $student->student_id; ?>]" value="unsuccessful" required> Unsuccessful
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="4">All service charges Verifyed</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
                <button type="submit" class="submit-btn">Submit Payments</button>


            </form>
            <a href="<?php echo URLROOT; ?>/NonAcademic/viewVerifyServiceCharges">
                <button class="byn btn-primary">
                    View Verified Service Charges
                </button>
            </a>
        </div>
    </div>
</body>

</html>
<?php require APPROOT . '/views/inc/footer.php'; ?>