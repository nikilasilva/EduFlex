<?php require APPROOT . '/views/inc/header.php'; ?> <!-- Include the header template -->
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?> <!-- Include the top navigation bar -->

<div class="layout">
    <!-- Sidebar -->
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?> <!-- Include the sidebar component -->

    <!-- Main content -->
    <div class="main-content">

        <!-- start calender -->
        <h1>Event Calendar</h1>
        <div class="calendar">
            <?php
            // Checking if events data exists
            if (isset($data['events'])) {
                $events = $data['events']; // Assign events data if available
            } else {
                $events = []; // Initialize as empty array if not available
            }

            // Calendar generation
            $daysInMonth = 30; // Set number of days to display
            echo '<div class="calendar-header"><strong>January 2024</strong></div>'; // Display month heading
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $date = '2024-01-' . str_pad($i, 2, '0', STR_PAD_LEFT); // Format the date as YYYY-MM-DD
                if (array_key_exists($date, $events)) {
                    echo "<div class='highlighted'>$i</div>";
                } else {
                    echo "<div>$i</div>";
                }
            }
            ?>
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