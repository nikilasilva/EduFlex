<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>



<div class="create-event-container">
    <div class="create-event-form-container">
        <h2>Create Event</h2>
        <form id="createEventForm" action="<?php echo URLROOT; ?>/ExtraEvent/SubmitCreateEvent" method="POST" onsubmit="return validateForm();" novalidate>
            <div>
                <label for="event_name">Event Name:</label>
                <input type="text" id="event_name" name="EventName" required>
                <div id="eventNameError" class="create-event-error-message"></div>
            </div>

            <div>
                <label for="event_date">Event Start Date & Time:</label>
                <input type="datetime-local" id="event_date" name="EventStartDateTime" required>
                <div id="eventDateError" class="create-event-error-message"></div>
            </div>

            <div>
                <label for="event_type">Event Type:</label>
                <select id="event_type" name="EventType" required>
                    <option value="">Select an event type</option>
                    <option value="sports">Sports</option>
                    <option value="academic">Academic</option>
                    <option value="cultural">Cultural</option>
                    <option value="exhibition">Exhibition</option>
                </select>
                <div id="eventTypeError" class="create-event-error-message"></div>
            </div>

            <div>
                <label for="venue">Venue:</label>
                <input type="text" id="venue" name="Venue" required>
                <div id="venueError" class="create-event-error-message"></div>
            </div>

            <div>
                <label>Target Audience:</label>
                <div class="checkbox-group">
                    <input type="checkbox" id="students" name="TargetAudience_students" value="students"> Students
                    <input type="checkbox" id="teachers" name="TargetAudience_teachers" value="teachers"> Teachers
                    <input type="checkbox" id="parents" name="TargetAudience_parents" value="parents"> Parents
                    <input type="checkbox" id="non_academic" name="TargetAudience_Academic" value="Non-Academic Staff"> Non-Academic Staff
                </div>
                <div id="audienceError" class="create-event-error-message"></div>
            </div>

            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="Description" required></textarea>
                <div id="descriptionError" class="create-event-error-message"></div>
            </div>

            <div>
                <label for="coordinator">Event Coordinator(s):</label>
                <input type="text" id="coordinator" name="EventCoordinators" required>
                <div id="coordinatorError" class="error-message"></div>
            </div>

            <button type="submit">Create Event</button>
        </form>
    </div>
</div>

<script>
// Set minimum date-time to now
window.onload = function() {
    const eventDateInput = document.getElementById('event_date');
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    eventDateInput.min = now.toISOString().slice(0,16);
};

function validateForm() {
    // Clear all previous error messages
    document.querySelectorAll('.error-message').forEach(el => el.innerText = '');

    let isValid = true;

    const eventName = document.getElementById('event_name').value.trim();
    const eventDate = document.getElementById('event_date').value.trim();
    const eventType = document.getElementById('event_type').value.trim();
    const venue = document.getElementById('venue').value.trim();
    const description = document.getElementById('description').value.trim();
    const coordinator = document.getElementById('coordinator').value.trim();
    const eventDateValue = new Date(eventDate);
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());

    const checkboxes = document.querySelectorAll('.checkbox-group input[type="checkbox"]');
    let audienceSelected = false;
    checkboxes.forEach(cb => {
        if (cb.checked) audienceSelected = true;
    });

    if (eventName === '') {
        document.getElementById('eventNameError').innerText = 'Please enter the event name.';
        isValid = false;
    }
    if (eventDate === '') {
        document.getElementById('eventDateError').innerText = 'Please select the event date and time.';
        isValid = false;
    } else if (eventDateValue < now) {
        document.getElementById('eventDateError').innerText = 'Event date and time cannot be in the past.';
        isValid = false;
    }
    if (eventType === '') {
        document.getElementById('eventTypeError').innerText = 'Please select an event type.';
        isValid = false;
    }
    if (venue === '') {
        document.getElementById('venueError').innerText = 'Please enter the venue.';
        isValid = false;
    }
    if (!audienceSelected) {
        document.getElementById('audienceError').innerText = 'Please select at least one target audience.';
        isValid = false;
    }
    if (description === '') {
        document.getElementById('descriptionError').innerText = 'Please enter a description.';
        isValid = false;
    }
    if (coordinator === '') {
        document.getElementById('coordinatorError').innerText = 'Please enter the event coordinator(s).';
        isValid = false;
    }

    return isValid;
}
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
