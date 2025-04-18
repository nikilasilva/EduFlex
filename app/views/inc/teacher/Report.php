<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="layout">
    <h1>Class Reports for <?php echo htmlspecialchars($data['classDetails']->name); ?></h1>

    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Average Marks</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['studentReports'] as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student->student_id); ?></td>
                    <td><?php echo htmlspecialchars($student->student_name); ?></td>
                    <td><?php echo htmlspecialchars(number_format($student->average_marks, 2)); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
