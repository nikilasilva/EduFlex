<?php require APPROOT . '/views/inc/header.php'; ?> <!-- Include the header template -->
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?> <!-- Include the top navigation bar -->

<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?> <!-- Include the sidebar component -->

    <!-- Main content -->
    <div class="main-content">

        <!-- start calender -->

        <div class="main-content">

            <!-- start calender -->
            <h1>Event Calendar</h1>
            <div class="calendar">
                <!-- ---------------------- -->



                <div class="calendar">


                    <?php
                    // Event data
                    $events = isset($data['events']) ? $data['events'] : [];

                    // Current date info
                    $currentYear = date('Y');
                    $currentMonth = date('m');
                    $todayDate = date('Y-m-d');
                    $monthName = date('F');

                    // Days in month and first day of month
                    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
                    $firstDayOfMonth = date('w', strtotime("$currentYear-$currentMonth-01")); // 0 (Sun) to 6 (Sat)

                    // Calendar heading
                    echo '<div class="calendar-header">' . $monthName . ' ' . $currentYear . '</div>';

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


                <!-- ----------------------------- -->

            </div>


            <!-- end calender part -->

            <div class="upcoming-events">
                <h2>Upcoming Events</h2>
                <hr>

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







        </div>
    </div>

    <?php require APPROOT . '/views/inc/footer.php'; ?> <!-- Include the footer template -->
</div>