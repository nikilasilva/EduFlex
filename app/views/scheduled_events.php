<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>

<div class="layout">
    <!-- Sidebar -->
    <div class="sidebar">
        <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <h1>Event Calendar</h1>
        <div class="calendar">
            <?php
            // Checking if events data exists
            if (isset($data['events'])) {
                $events = $data['events'];
            } else {
                $events = [];
            }

            // Calendar generation
            $daysInMonth = 31;
            echo '<div class="calendar-header"><strong>January 2024</strong></div>';
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $date = '2024-01-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                if (array_key_exists($date, $events)) {
                    echo "<div class='highlighted'>$i</div>";
                } else {
                    echo "<div>$i</div>";
                }
            }
            ?>
        </div>

        <div class="upcoming-events">
            <div class="box">
                <h2>Upcoming Events</h2>
                <?php if (isset($data['upcomingEvents'])): ?>
                    <?php foreach ($data['upcomingEvents'] as $event): ?>
                        <div class="event-item">
                            <span class="event-date"><?= $event['date'] ?></span>
                            <p><?= $event['description'] ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No upcoming events.</p>
                <?php endif; ?>
            </div>

            <div class="box">
                <h2>Reminders</h2>
                <?php if (isset($data['reminders'])): ?>
                    <?php foreach ($data['reminders'] as $reminder): ?>
                        <div class="event-item">
                            <span class="event-date"><?= $reminder['date'] ?></span>
                            <p><?= $reminder['description'] ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No reminders available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT.'/views/inc/footer.php'; ?>
