<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<div class="announcement-container">
    <h1 class="page-title"><?php echo $data['title']; ?></h1>
    
    <?php if (!empty($data['announcements'])): ?>
        <table class="announcement-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Target Audience</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['announcements'] as $index => $announcement): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($announcement->title); ?></td>
                        <td><?php echo htmlspecialchars($announcement->type); ?></td>
                        <td><?php echo htmlspecialchars($announcement->target_audience); ?></td>
                        <td><?php echo htmlspecialchars($announcement->date); ?></td>
                        <td><?php echo htmlspecialchars($announcement->time); ?></td>
                        <td>
                            <a href="<?php echo URLROOT; ?>/Announcement/updateAnnouncement/<?php echo $announcement->id; ?>" class="btn btn-edit">Edit</a>
                            <a href="<?php echo URLROOT; ?>/Announcement/deleteAnnouncement/<?php echo $announcement->id; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this announcement?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No announcements found.</p>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
