<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<div class="layout">
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

    <div class="attendance-container">
        <h1>Student Leaving Certificates</h1>

        <table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>student_id</th>
            <th>time_slot</th>
            <th>Student ID</th>
            <th>day</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['allocatedLeavingCertificates'])): ?>
            <?php foreach ($data['allocatedLeavingCertificates'] as $leavingCertificates): ?>
                <tr>
                    <td><?php echo $leavingCertificates->student_id; ?></td>
                    <td><?php echo $leavingCertificates->certificate_id; ?></td>
                    <td><?php echo $leavingCertificates->time_slot; ?></td>
                    <td><?php echo $leavingCertificates->day; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No Character certificates found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
