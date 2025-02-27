<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<div class="report-container">

<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>


    <h1 class="report-title">Class Report</h1>

    <h2 class="report-subtitle">Subject-wise Report</h2>
    <table class="report-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Subject</th>
                <th>Total Marks Obtained</th>
                <th>Total Marks Possible</th>
                <th>Average Marks</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['classReport'])): ?>
                <?php foreach ($data['classReport'] as $report): ?>
                    <tr>
                        <td><?= htmlspecialchars($report['student_id']) ?></td>
                        <td><?= htmlspecialchars($report['subject']) ?></td>
                        <td><?= htmlspecialchars($report['total_marks_obtained']) ?></td>
                        <td><?= htmlspecialchars($report['total_marks_possible']) ?></td>
                        <td><?= htmlspecialchars($report['average_marks']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No subject-wise records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2 class="report-subtitle">Class Ranks</h2>
    <table class="report-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Student ID</th>
                <th>Total Marks Obtained</th>
                <th>Total Marks Possible</th>
                <th>Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['ranks'])): ?>
                <?php $rank = 1; ?>
                <?php foreach ($data['ranks'] as $student): ?>
                    <tr>
                        <td><?= $rank++ ?></td>
                        <td><?= htmlspecialchars($student['student_id']) ?></td>
                        <td><?= htmlspecialchars($student['total_marks_obtained']) ?></td>
                        <td><?= htmlspecialchars($student['total_marks_possible']) ?></td>
                        <td><?= number_format($student['percentage'], 2) ?>%</td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No ranking data available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

