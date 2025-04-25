<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<div class="layout">
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

    <div class="attendance-container">
        <h1>Student Character Certificates</h1>

        <table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Certificate ID</th>
            <th>Full Name</th>
            <th>Student ID</th>
            <th>Date of Birth</th>
            <th>Guardian Name</th>
            <th>Address</th>
            <th>slip</th>
            <th>Status</th> <!-- New column -->
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['characterCertificates'])): ?>
            <?php foreach ($data['characterCertificates'] as $characterCertificates): ?>
                <tr>
                    <td><?php echo $characterCertificates->certificate_id; ?></td>
                    <td><?php echo $characterCertificates->full_name; ?></td>
                    <td><?php echo $characterCertificates->student_id; ?></td>
                    <td><?php echo $characterCertificates->date_of_birth; ?></td>
                    <td><?php echo $characterCertificates->guardian_name; ?></td>
                    <td><?php echo $characterCertificates->address; ?></td>
                    <td><?php echo $characterCertificates->slip; ?></td>
                    <td>
                        <?php if ($characterCertificates->status == 0): ?>
                            <form method="post" action="<?php echo URLROOT; ?>/NonAcademic/markCharacterCertificateComplete/<?php echo $characterCertificates->certificate_id; ?>">
                                <button type="submit" style="padding: 6px 12px; background-color:rgb(255, 0, 0); color: white; border: none; border-radius: 4px;">Complete Character Certificate</button>
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
