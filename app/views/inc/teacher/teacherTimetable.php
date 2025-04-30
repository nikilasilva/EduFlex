<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<div class="logged-teacher-tt container">
    <h1><?php echo $_SESSION['user']['nameWithInitial']?> - Timetable</h1>
    <table class="timetable" id="loggedTeacherTimetableTable">
        <thead>
            <tr>
                <th>Period</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>
        </thead>
        <tbody id="teacherTimetableTableBody">
            <?php
            // Define periods array
            $periods = ["Period 1", "Period 2", "Period 3", "Period 4", "Period 5", "Period 6", "Period 7", "Period 8"];
            $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
           
            // Create an empty 2D array to store timetable data
            $timetableData = [];
           
            // Initialize the array with empty values
            foreach ($periods as $period) {
                foreach ($days as $day) {
                    $timetableData[$period][$day] = ["subjectName" => "", "className" => "", "roomNumber" => ""];
                }
            }
           
            // Fill the array with the data from controller
            if (isset($data['timeTable']) && !empty($data['timeTable'])) {
                foreach ($data['timeTable'] as $entry) {
                    $periodName = $entry->periodName;
                    $day = $entry->day;
                    $timetableData[$periodName][$day] = [
                        "subjectName" => $entry->subjectName,
                        "className" => $entry->className,
                        "roomNumber" => $entry->roomNumber
                    ];
                }
            }
           
            // Generate table rows
            foreach ($periods as $period) {
                echo "<tr>";
                echo "<td class='period-col'>$period</td>";
               
                foreach ($days as $day) {
                    $subject = $timetableData[$period][$day]["subjectName"];
                    $class = $timetableData[$period][$day]["className"];
                    $room = $timetableData[$period][$day]["roomNumber"];
                   
                    if (!empty($subject) && !empty($class) && !empty($room)) {
                        echo "<td>";
                        echo "<div class='subject-name'>$subject</div>";
                        echo "<div class='class-name'>$class</div>";
                        echo "<div class='room-number'>$room</div>";
                        echo "</td>";
                    } else {
                        echo "<td><div class='not-assigned'>Not Assigned</div></td>";
                    }
                }
               
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
