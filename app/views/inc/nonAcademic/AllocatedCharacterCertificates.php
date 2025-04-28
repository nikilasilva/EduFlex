<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<div class="layout">
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

    <div class="attendance-container">
        <h1>Allocated Student Character Certificates</h1>

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
        <?php if (!empty($data['allocatedCharacterCertificates'])): ?>
            <?php foreach ($data['allocatedCharacterCertificates'] as $characterCertificates): ?>
                <tr>
                    <td><?php echo $characterCertificates->student_id; ?></td>
                    <td><?php echo $characterCertificates->certificate_id; ?></td>
                    <td><?php echo $characterCertificates->time_slot; ?></td>
                    <td><?php echo $characterCertificates->day; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No Allocated Character certificates found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
