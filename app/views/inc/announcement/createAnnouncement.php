<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<div class="announcement-container">
    <h1>Create Announcement</h1>
    <form action="<?= URLROOT ?>/announcement/submitAnnouncement" method="POST">
        <div class="form-group">
            <label for="announcement-title">Announcement Title</label>
            <input type="text" id="announcement-title" name="announcement-title" 
                   value="<?= $data['title'] ?>" placeholder="Enter announcement title" required>
            <?php if (!empty($data['errors']['title'])): ?>
                <span class="error"><?= $data['errors']['title'] ?></span>
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
                <span class="error"><?= $data['errors']['type'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Target Audience</label>
            <div class="checkbox-group">
                <?php
                $audiences = ['Students', 'Teachers', 'Parents', 'Non-academic Staff', 'Vice-Principals'];
                foreach ($audiences as $audience): ?>
                    <label>
                        <input type="checkbox" name="audience[]" value="<?= $audience ?>"
                               <?= in_array($audience, explode(',', $data['target_audience'])) ? 'checked' : '' ?>>
                        <?= ucfirst($audience) ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <?php if (!empty($data['errors']['target_audience'])): ?>
                <span class="error"><?= $data['errors']['target_audience'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="announcement-content">Announcement Content</label>
            <textarea id="announcement-content" name="announcement-content" 
                      placeholder="Enter announcement content" required><?= $data['content'] ?></textarea>
            <?php if (!empty($data['errors']['content'])): ?>
                <span class="error"><?= $data['errors']['content'] ?></span>
            <?php endif; ?>
        </div>

        <div class="date-time-container">
            <div class="form-group">
                <label for="announcement-date">Date</label>
                <input type="date" id="announcement-date" name="announcement-date" 
                       value="<?= $data['date'] ?>" required>
                <?php if (!empty($data['errors']['date'])): ?>
                    <span class="error"><?= $data['errors']['date'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="announcement-time">Time</label>
                <input type="time" id="announcement-time" name="announcement-time" 
                       value="<?= $data['time'] ?>" required>
                <?php if (!empty($data['errors']['time'])): ?>
                    <span class="error"><?= $data['errors']['time'] ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="button-group">
            <button type="submit">Create Announcement</button>
            <button type="reset">Clear</button>
        </div>
    </form>

    <!-- New Button: View All Announcements -->
    <div class="view-all-container">
        <a href="<?= URLROOT ?>/Announcement/viewAnnouncement" class="btn btn-view-all">View All Announcements</a>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
