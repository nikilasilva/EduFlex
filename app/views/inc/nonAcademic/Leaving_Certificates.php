<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<div class="layout">
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

    <div class="attendance-container">
        <h1>Student Leaving Certificates</h1>

        <table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Certificate ID</th>
            <th>Full Name</th>
            <th>Student ID</th>
            <th>Date of Birth</th>
            <th>Admission Date</th>
            <th>Reason for Leaving</th>
            <th>Status</th> <!-- New column -->
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['LeavingCertificates'])): ?>
            <?php foreach ($data['LeavingCertificates'] as $certificate): ?>
                <tr>
                    <td><?php echo $certificate->certificate_id; ?></td>
                    <td><?php echo $certificate->full_name; ?></td>
                    <td><?php echo $certificate->student_id; ?></td>
                    <td><?php echo $certificate->DOB; ?></td>
                    <td><?php echo $certificate->Admission_date; ?></td>
                    <td><?php echo $certificate->Reason; ?></td>
                    <td>
                        <?php if ($certificate->status == 0): ?>
                            <form method="post" action="<?php echo URLROOT; ?>/NonAcademic/markCertificateComplete/<?php echo $certificate->certificate_id; ?>">
                                <button type="submit" style="padding: 6px 12px; background-color:rgb(255, 0, 0); color: white; border: none; border-radius: 4px;">Complete Leaving Certificate</button>
                            </form>
                        <?php else: ?>
                            <button disabled style="padding: 6px 12px; background-color:rgb(4, 255, 0); color: white; border: none; border-radius: 4px;">Sent Email</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No leaving certificates found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
