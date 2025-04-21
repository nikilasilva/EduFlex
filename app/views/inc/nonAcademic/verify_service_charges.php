<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Service Charges</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/attendance.css">
    <style>
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
    </style>
</head>

<body>
    <div class="layout">
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <div class="attendance-container">
            <h1>Download Service Charges - Student Payments Slip</h1>

            <form method="post" action="<?php echo URLROOT; ?>/NonAcademic/SubmitServiceCharges" enctype="multipart/form-data">
                <table border="1" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Payment Slip</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data['serviceCharges'])): ?>
                            <?php foreach ($data['serviceCharges'] as $student): ?>
                                <tr>
                                    <td><?php echo $student->student_id; ?></td>
                                    <td><?php echo $student->full_name; ?></td>
                                    <td>
                                        <?php echo $student->payment_slip; ?>
                                        <!-- <input type="file" name="payment_slips[<?php echo $student->student_id; ?>]" accept="image/*,application/pdf" required> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No students found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <button type="submit" class="submit-btn">Submit Payments</button>
            </form>
        </div>
    </div>
</body>

</html>
<?php require APPROOT . '/views/inc/footer.php'; ?>