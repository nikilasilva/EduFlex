<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="attendance-container">
    <h1>Absence Reports for <?php echo htmlspecialchars($data['date']); ?></h1>
    <h2><?php echo htmlspecialchars($data['className']); ?></h2>

    <table>
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Reason</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['absences'])): ?>
            <?php foreach ($data['absences'] as $absence): ?>
                <tr>
                    <td><?php echo htmlspecialchars($absence['student_id']); ?></td>
                    <td><?php echo htmlspecialchars($absence['name']); ?></td>
                    <td><?php echo htmlspecialchars($absence['content']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No absence reports for this class and date.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>



<button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/teacher/attendance';" class="btn-back"><< Back</button>



</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
