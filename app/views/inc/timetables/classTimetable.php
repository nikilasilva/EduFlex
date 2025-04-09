<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<div class="class-timetable-container timetable-container">
    <h1>Class Timetable</h1>
    <div class="search-bar">
        <input type="text" placeholder="Search by Class">
        <select id="classSelect">
            <option value="">Select Class</option>
            <?php foreach ($data['classes'] as $class): ?>
                <option value="<?= $class->classId ?>">
                    <?= htmlspecialchars($class->className) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select id="daySelect">
            <option value="">Select Day</option>
            <option value="1">Monday</option>
            <option value="2">Tuesday</option>
            <option value="3">Wednesday</option>
            <option value="4">Thursday</option>
            <option value="5">Friday</option>
            <option value="6">All</option>
        </select>

        <button>SEARCH</button>
    </div>
    <p id="selectionMessage" class="hidden-message">
        Please select both a class and a day to view the timetable.
    </p>
    <table class="timetable" id="timetableTable">
        <thead>
            <tr>
                <th>Time</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>
        </thead>
        <tbody id="studentTableBody">
            <!-- Student data will be inserted here -->
        </tbody>
    </table>
    <div class="pagination" id="pagination">
        <button>Previous</button>
        <button class="active">1</button>
        <button>2</button>
        <button>3</button>
        <button>Next</button>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>