<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<div class="teacher-timetable-container timetable-container container">
    <h1>Teacher Timetable</h1>
    <div class="search-bar">
        <form class="teacher-timetable-form" action="<?= URLROOT ?>/Timetable/teacherTimetable" method="POST">
            <select id="teacherSelect" name="teacherId">
                <option value="">Select Teacher</option>
                <?php foreach ($data['teachers'] as $teacher): ?>
                    <option value="<?= $teacher->teacherId ?>">
                        <?= htmlspecialchars($teacher->teacherName) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select id="daySelect" name="day">
                <option value="">Select Day</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
            </select>

            <button class="teacher-timetable-form-btn">SEARCH</button>
        </form>
    </div>

    <h2 id="timetableHeader" style="display: none"></h2>
    <!-- filepath: c:\xampp\htdocs\EduFlex\app\views\inc\timetables\teacherTimetable.php -->
    <p id="selectionMessage" class="hidden-message" style="display: none;">
        Please select both a teacher and a day to view the timetable.
    </p>


    <table class="timetable" id="timetableTable" style="display: none;">
        <thead>
            <tr>
                <th>Period</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Subject</th>
                <th>Class</th>
                <th>Room</th>
            </tr>
        </thead>
        <tbody id="timetableTableBody">
            <!-- Rows will be dynamically added here -->
        </tbody>
    </table>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>