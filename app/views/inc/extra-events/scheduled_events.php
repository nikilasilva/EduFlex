<?php require APPROOT . '/views/inc/header.php'; ?> <!-- Include the header template -->
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?> <!-- Include the top navigation bar -->

<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?> <!-- Include the sidebar component -->

    <!-- Main content -->
    

        <!-- start calender -->

        <div class="main-content container">

            <!-- start calender -->
            <h1>Event Calendar</h1>

            <div class="calendar">

                <?php
                // Get month and year from URL, fallback to current
                $currentYear = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
                $currentMonth = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
                $todayDate = date('Y-m-d');
                $monthName = date('F', strtotime("$currentYear-$currentMonth-01"));

                // Calculate previous and next month
                $prevMonth = $currentMonth - 1;
                $prevYear = $currentYear;
                if ($prevMonth < 1) {
                    $prevMonth = 12;
                    $prevYear--;
                }

                $nextMonth = $currentMonth + 1;
                $nextYear = $currentYear;
                if ($nextMonth > 12) {
                    $nextMonth = 1;
                    $nextYear++;
                }

                // Sample event data
                $events = isset($data['events']) ? $data['events'] : [];

                // Days and first weekday
                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
                $firstDayOfMonth = date('w', strtotime("$currentYear-$currentMonth-01")); // 0 (Sun) to 6 (Sat)

                // Calendar heading with navigation
                echo '<div class="calendar-header">';
                echo "<a href='?month=$prevMonth&year=$prevYear' class='calendar-nav'>&laquo; Prev</a> ";
                echo "$monthName $currentYear";
                echo " <a href='?month=$nextMonth&year=$nextYear' class='calendar-nav'>Next &raquo;</a>";
                echo '</div>';

                // Day names
                $dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                foreach ($dayNames as $day) {
                    echo "<div class='calendar-day-name'>$day</div>";
                }

                // Empty cells before the 1st day
                for ($i = 0; $i < $firstDayOfMonth; $i++) {
                    echo "<div class='calendar-day'></div>";
                }

                // Calendar days
                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $date = "$currentYear-" . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . "-" . str_pad($day, 2, '0', STR_PAD_LEFT);

                    $class = 'calendar-day';
                    if ($date === $todayDate) $class .= ' today';
                    if (array_key_exists($date, $events)) $class .= ' highlighted';

                    echo "<div class='$class'>$day</div>";
                }
                ?>
            </div>

            

            <!-- end calender part -->
            <h2>Upcoming Events</h2>

            <div class="upcoming-events">

                <?php if (!empty($data['upcomingEvents'])): ?>
                    <?php foreach ($data['upcomingEvents'] as $event): ?>
                        <div class="box">
                            <div class="event-item">
                                <span class="event-date"><?= htmlspecialchars($event['date']) ?></span>
                                <p><?= htmlspecialchars($event['description']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="box">
                        <p>No upcoming events.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- show upcomming event  -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const eventBoxes = document.querySelectorAll('.upcoming-events .box');

                    eventBoxes.forEach(box => {
                        box.addEventListener('click', function () {
                            const eventDate = this.querySelector('.event-date').textContent;
                            const eventDescription = this.querySelector('p').textContent;

                            // Create modal structure
                            const modal = document.createElement('div');
                            modal.className = 'event-modal';

                            modal.innerHTML = `
                                <div class="event-modal-content">
                                    <span class="event-modal-close">&times;</span>
                                    <h2>Event Details</h2>
                                    <p><strong>Date:</strong> ${eventDate}</p>
                                    <p><strong>Description:</strong> ${eventDescription}</p>
                                </div>
                            `;

                            document.body.appendChild(modal);

                            // Close modal on click of close button
                            modal.querySelector('.event-modal-close').addEventListener('click', function () {
                                modal.remove();
                            });

                            // Close modal on outside click
                            modal.addEventListener('click', function (e) {
                                if (e.target === modal) {
                                    modal.remove();
                                }
                            });
                        });
                    });
                });
            </script>

            <style>
                
            </style>


        </div> <!-- End of main content -->


    <!-- End of main content -->
</div>
<!-- End of layout -->
<?php require APPROOT . '/views/inc/footer.php'; ?>  <!-- Include the footer template -->

