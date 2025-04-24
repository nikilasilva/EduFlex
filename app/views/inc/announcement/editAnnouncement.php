<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<div class="announcement-container">
    <h1>Edit Announcement</h1>
    <form action="<?= URLROOT ?>/announcement/updateAnnouncement/<?= $data['id'] ?>" method="POST">
        <div class="form-group">
            <label for="announcement-title">Announcement Title</label>
            <input type="text" id="announcement-title" name="announcement-title" 
                   value="<?= htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8') ?>" placeholder="Enter announcement title" required>
            <?php if (!empty($data['errors']['title'])): ?>
                <span class="error"><?= htmlspecialchars($data['errors']['title'], ENT_QUOTES, 'UTF-8') ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="announcement-type">Announcement Type</label>
            <select id="announcement-type" name="announcement-type" required>
                <option value="">Select type</option>
                <option value="general" <?= $data['type'] === 'general' ? 'selected' : '' ?>>General</option>
                <option value="academic" <?= $data['type'] === 'academic' ? 'selected' : '' ?>>Academic</option>
                <option value="event" <?= $data['type'] === 'event' ? 'selected' : '' ?>>Event</option>
                <option value="emergency" <?= $data['type'] === 'emergency' ? 'selected' : '' ?>>Emergency</option>
                <option value="sports" <?= $data['type'] === 'sports' ? 'selected' : '' ?>>Sports</option>
            </select>
            <?php if (!empty($data['errors']['type'])): ?>
                <span class="error"><?= htmlspecialchars($data['errors']['type'], ENT_QUOTES, 'UTF-8') ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Target Audience</label>
            <div class="checkbox-group">
                <?php 
                // Ensure target_audience is converted to an array
                $targetAudience = isset($data['target_audience']) 
                    ? (is_array($data['target_audience']) 
                        ? $data['target_audience'] 
                        : explode(',', $data['target_audience'])) 
                    : [];
                ?>
                <label>
                    <input type="checkbox" name="target_audience[]" value="students" 
                        <?= in_array('students', $targetAudience) ? 'checked' : '' ?>>
                    Students
                </label>
                <label>
                    <input type="checkbox" name="target_audience[]" value="teachers" 
                        <?= in_array('teachers', $targetAudience) ? 'checked' : '' ?>>
                    Teachers
                </label>
                <label>
                    <input type="checkbox" name="target_audience[]" value="parents" 
                        <?= in_array('parents', $targetAudience) ? 'checked' : '' ?>>
                    Parents
                </label>
                <label>
                    <input type="checkbox" name="target_audience[]" value="non-academic staff" 
                        <?= in_array('non-academic staff', $targetAudience) ? 'checked' : '' ?>>
                    Non-Academic Staff
                </label>
                <label>
                    <input type="checkbox" name="target_audience[]" value="vice-principals" 
                        <?= in_array('vice-principals', $targetAudience) ? 'checked' : '' ?>>
                    Vice-principals
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="announcement-content">Announcement Content</label>
            <textarea id="announcement-content" name="announcement-content" 
                      placeholder="Enter announcement content" required><?= htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8') ?></textarea>
            <?php if (!empty($data['errors']['content'])): ?>
                <span class="error"><?= htmlspecialchars($data['errors']['content'], ENT_QUOTES, 'UTF-8') ?></span>
            <?php endif; ?>
        </div>

        <div class="date-time-container">
            <div class="form-group">
                <label for="announcement-date">Date</label>
                <input type="date" id="announcement-date" name="announcement-date" 
                       value="<?= htmlspecialchars($data['date'], ENT_QUOTES, 'UTF-8') ?>" required>
                <?php if (!empty($data['errors']['date'])): ?>
                    <span class="error"><?= htmlspecialchars($data['errors']['date'], ENT_QUOTES, 'UTF-8') ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="announcement-time">Time</label>
                <input type="time" id="announcement-time" name="announcement-time" 
                       value="<?= htmlspecialchars($data['time'], ENT_QUOTES, 'UTF-8') ?>" required>
                <?php if (!empty($data['errors']['time'])): ?>
                    <span class="error"><?= htmlspecialchars($data['errors']['time'], ENT_QUOTES, 'UTF-8') ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="button-group-announcement">
            <button type="submit">Update Announcement</button>
            <button class="cancel-ann-btn" type="reset">Cancel</button>
        </div>
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
