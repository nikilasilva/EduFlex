<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>


<div class="class-report-container container printable-area">
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

    <div class="download-btn-container no-print">
        <button onclick="window.print()" class="btn btn-success">Download as PDF</button>
    </div>

    <h1 class="report-title"><?php echo htmlspecialchars($data['className']); ?> Report - Term <?= htmlspecialchars($term ?? 'N/A') ?></h1>

    <?php if (!empty($data['message'])): ?>
        <p style="color: red; font-weight: bold; padding: 10px;">
            <?= htmlspecialchars($data['message']) ?>
        </p>
    <?php else: ?>

    <form action="<?= URLROOT ?>/teacher/updateMarks" method="post">
        <input type="hidden" name="term" value="<?= htmlspecialchars($term) ?>">
        <input type="hidden" name="class" value="<?= $class ?? '' ?>">

        <h2 class="report-subtitle">Subject-wise Report</h2>
        <table class="report-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <?php
                    $subjectHeaders = [];
                    if (!empty($data['classReport'])) {
                        foreach ($data['classReport'] as $report) {
                            foreach ($report['subjects'] as $subject => $mark) {
                                $subjectHeaders[$subject] = true;
                            }
                            break;
                        }
                    }
                    ?>
                    <?php foreach (array_keys($subjectHeaders) as $subjectName): ?>
                        <th><?= htmlspecialchars($subjectName) ?></th>
                    <?php endforeach; ?>
                    <th>Total Marks Obtained</th>
                    <th>Average Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['classReport'])): ?>
                    <?php foreach ($data['classReport'] as $report): ?>
                        <tr>
                            <td><?= htmlspecialchars($report['student_id']) ?> - <?= htmlspecialchars($report['student_name']) ?></td>

                            <?php foreach (array_keys($subjectHeaders) as $subjectName): ?>
                                <td>
                                    <input type="number" name="marks[<?= $report['student_id'] ?>][<?= $subjectName ?>]" value="<?= htmlspecialchars($report['subjects'][$subjectName] ?? '0') ?>" min="0" max="100" required>
                                </td>
                            <?php endforeach; ?>
                            <td><?= htmlspecialchars($report['total_marks_obtained']) ?></td>
                            <td><?= number_format($report['average_marks'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="<?= count($subjectHeaders) + 3 ?>">No subject-wise records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div style="margin-top: 20px;" class="no-print">
            <button type="submit" class="btn btn-primary">Update Marks</button>
        </div>
    </form>

    <h2 class="report-subtitle">Class Ranks</h2>
    <table class="report-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Student ID</th>
                <th>Total Marks Obtained</th>
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
                        <td><?= number_format($student['percentage'], 2) ?>%</td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No ranking data available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <a href="<?php echo URLROOT; ?>/teacher/selectClassForViewReport" class="btn-back">
    << Back
</a>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
