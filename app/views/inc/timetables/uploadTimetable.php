<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="upload-timetable-container">
    <h1>Upload Timetable CSV</h1>
    <form action="<?php echo URLROOT; ?>/Timetable/uploadTimetableProcess" method="post" enctype="multipart/form-data" novalidate>
        <div class="form-group">
            <label class="timetable_csv_label" for="timetable_csv">Select a CSV File</label>
            <input type="file" class="form-control" id="timetable_csv" name="timetable_csv" accept=".csv" required>
            <!-- <?php if (!empty($data['errors']['timetable_csv'])): ?>
                <span class="error"><?= $data['errors']['timetable_csv'] ?></span>
            <?php endif; ?> -->
            <p>
                File should contain: <p class="users-csv-headings">className, subjectName, teacherFullName, periodId, day, roomNumber</p>
            </p>
        </div>
        
        <div class="form-group">
            <label class="academic_year-label" for="academic_year">Academic Year</label>
            <select class="form-control" id="academic_year" name="academic_year" required>
                <option value="">Select Academic Year</option>
                <?php foreach ($data['academicYears'] as $year): ?>
                    <option value="<?php echo $year->academicYear; ?>"><?php echo $year->academicYear; ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($data['errors']['academic_year'])): ?>
                <span class="error"><?= $data['errors']['academic_year'] ?></span>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <a href="<?php echo URLROOT; ?>/Timetable/downloadTemplate" class="btn btn-outline-secondary">Download Template</a>
        </div>

        <!-- <div class="form-group">
            <a href="<?php echo URLROOT; ?>/templates/timetable_template.csv" class="btn btn-outline-secondary">Download Template</a>
        </div> -->
        
        <button type="submit" class="btn btn-primary">Upload and Process</button>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>