<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Activity</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">

    <!-- Add Select2 CSS for searchable dropdown -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
</head>


<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="record-container">
            <h1>Record Activity</h1>

            <!-- Alert messages -->
            <?php if (isset($data['error'])): ?>
                <div class="alert alert-danger">
                    <?php echo $data['error']; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($data['success'])): ?>
                <div class="alert alert-success">
                    <?php echo $data['success']; ?>
                </div>
            <?php endif; ?>

            <!-- Daily Activities form -->
            <form action="<?php echo URLROOT; ?>/teacher/submitActivities" method="POST" novalidate>

            <div class="form-group">
                <label for="attendance_date">Date:</label>
                <input
                    type="date"
                    id="attendance_date"
                    name="attendance_date"
                    max="<?= date('Y-m-d') ?>"
                    value="<?= $data['form_data']['attendance_date'] ?? ''; ?>"
                    required>
                <?php if (!empty($data['form_errors']['attendance_date'])): ?>
                    <span class="error"><?= htmlspecialchars($data['form_errors']['attendance_date']) ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="period">Period:</label>
                <select name="period" id="period" required>
                    <option value="">Select Period</option>
                    <?php for ($i = 1; $i <= 8; $i++): ?>
                        <option value="<?php echo $i; ?>" <?= (isset($data['form_data']['period']) && $data['form_data']['period'] == $i) ? 'selected' : ''; ?>>
                            Period <?php echo $i; ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <?php if (!empty($data['form_errors']['period'])): ?>
                    <span class="error"><?= htmlspecialchars($data['form_errors']['period']) ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="subject">Subject:</label>
                <select name="subject" id="subject" class="searchable" required>
                    <option value="">Search or Select a Subject</option>
                    <?php foreach ($data['subjects'] as $subject): ?>
                        <option value="<?= $subject->subjectName ?>" <?= (isset($data['form_data']['subject']) && $data['form_data']['subject'] == $subject->subjectName) ? 'selected' : ''; ?>>
                            <?= $subject->subjectName ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($data['form_errors']['subject'])): ?>
                    <span class="error"><?= htmlspecialchars($data['form_errors']['subject']) ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="class">Class:</label>
                <select name="class" id="class" class="searchable" required>
                    <option value="">Search or Select a Class</option>
                    <?php foreach ($data['classes'] as $class): ?>
                        <option value="<?= $class->classId ?>" <?= (isset($data['form_data']['class']) && $data['form_data']['class'] == $class->classId) ? 'selected' : ''; ?>>
                            <?= $class->className ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (!empty($data['form_errors']['class'])): ?>
                    <span class="error"><?= htmlspecialchars($data['form_errors']['class']) ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="description">Name of the lesson / Nature of work done:</label>
                <textarea name="description" id="description" rows="4" required><?= $data['form_data']['description'] ?? ''; ?></textarea>
                <?php if (!empty($data['form_errors']['description'])): ?>
                    <span class="error"><?= htmlspecialchars($data['form_errors']['description']) ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="additional_note">Additional Notes:</label>
                <textarea name="additional_note" id="additional_note" rows="4"><?= $data['form_data']['additional_note'] ?? ''; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Activity</button><br><br>
            <button type="button" onclick="window.location.href='<?php echo URLROOT; ?>/teacher/viewActivities'" class="btn btn-primary">View All Records</button><br><br>
            <a href="<?php echo URLROOT; ?>/teacher/viewActivities" class="btn btn-secondary">Cancel</a>
        </form>
        </div>
    </div>
</body>

</html>
<?php require APPROOT . '/views/inc/footer.php'; ?>  