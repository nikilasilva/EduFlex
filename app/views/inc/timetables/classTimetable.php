<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<div class="class-timetable-container timetable-container container">
    <h1>Class Timetable</h1>
    <div class="search-bar">
        <form class="class-timetable-form" action="<?= URLROOT ?>/Timetable/classTimetable" method="POST">
            <select id="classSelect" name="classId">
                <option value="">Select Class</option>
                <?php foreach ($data['classes'] as $class): ?>
                    <option value="<?= $class->classId ?>">
                        <?= htmlspecialchars($class->className) ?>
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


            <button class="class-timetable-form-btn">SEARCH</button>
        </form>
    </div>
    
    <h2 id="timetableHeader" style="display: none"></h2>
    <!-- filepath: c:\xampp\htdocs\EduFlex\app\views\inc\timetables\classTimetable.php -->
    <p id="selectionMessage" class="hidden-message" style="display: none;">
        Please select both a class and a day to view the timetable.
    </p>


    <table class="timetable" id="timetableTable" style="display: none;">
        <thead>
            <tr>
                <th>Period</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Subject</th>
                <th>Teacher</th>
                <th>Room</th>
            </tr>
        </thead>
        <tbody id="timetableTableBody">
            <!-- Rows will be dynamically added here -->
        </tbody>
    </table>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>