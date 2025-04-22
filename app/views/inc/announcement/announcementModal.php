<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="announcement-box-container">
    <h1 class="page-title">Announcements</h1>

    <?php if (!empty($data['announcements'])): ?>
        <div class="announcement-boxes">
            <?php foreach ($data['announcements'] as $announcement): ?>
                <div class="announcement-box">
                    <div class="announcement-type"><?php echo ucwords(htmlspecialchars($announcement->type)); ?></div>
                    <h2 class="announcement-title"><?php echo ucwords(htmlspecialchars($announcement->title)); ?></h2>
                    <p class="announcement-content"><?php echo htmlspecialchars($announcement->content); ?></p>
                    <div class="announcement-meta">
                        <span class="announcement-date"><?php echo htmlspecialchars($announcement->date); ?></span>
                        <span class="announcement-time"><?php echo htmlspecialchars(date('H:i', strtotime($announcement->time))); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="no-announcements">No announcements found.</p>
    <?php endif; ?>
    <?php if ($data['totalPages'] > 1): ?>
        <div class="pagination">
            <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                <a href="<?php echo URLROOT; ?>/Announcement/announcements/<?php echo $i; ?>" class="<?php echo $i == $data['page'] ? 'active' : ''; ?>" aria-label="Page <?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
