<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<div class="create-event-container">
    <div class="create-event-form-container">
        <h2>Create Event</h2>
        <form>
        <label for="event_name">Event Name:</label>
        <input type="text" id="event_name" name="event_name" required>

        <label for="event_date">Event Start Date & Time:</label>
        <input type="datetime-local" id="event_date" name="event_date" required>

        <label for="event_type">Event Type:</label>
        <select id="event_type" name="event_type" required>
            <option value="sports">Sports</option>
            <option value="academic">Academic</option>
            <option value="cultural">Cultural</option>
            <option value="exhibition">Exhibition</option>
        </select>

        <label for="venue">Venue:</label>
        <input type="text" id="venue" name="venue" required>

        <label>Target Audience:</label>
        <div class="checkbox-group">
            <input type="checkbox" name="target_audience[]" value="students"> Students
            <input type="checkbox" name="target_audience[]" value="teachers"> Teachers
            <input type="checkbox" name="target_audience[]" value="parents"> Parents
            <input type="checkbox" name="target_audience[]" value="non-academic staff"> Non-Academic Staff
        </div>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="coordinator">Event Coordinator(s):</label>
        <input type="text" id="coordinator" name="coordinator" required>

        <button type="submit">Create Event</button>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>