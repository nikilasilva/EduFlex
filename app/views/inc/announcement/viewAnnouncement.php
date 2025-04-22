<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<div class="announcement-container">
    <h1 class="page-title"><?php echo $data['title']; ?></h1>
    
    <!-- Flash message  -->
    <?php if(isset($data['message']) && !empty($data['message'])): ?>
        <div id="flash-message" class="alert alert-success">
            <?php echo $data['message']; ?>
        </div>
    <?php endif; ?>
    
    <?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
        <div id="flash-message" class="alert alert-danger">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>


    
    <div class="search-bar announcement-search-bar">
        <input type="text" id="announcement-search" placeholder="Search announcements by title, content, type, or audience" aria-label="Search announcements">
    </div>

    <div class="announcement-count-wrapper">
        <p class="announcement-count">Showing: <?php echo $data['announcementCount']; ?> Result(s) out of <?php echo $data['announcementTotal']; ?> Total</p>
        <!-- <p class="announcement-count">Total Announcements: <?php echo $data['announcementCount']; ?></p> -->
    </div>
    
    <?php if (!empty($data['announcements'])): ?>
        <table class="announcement-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
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
                        <td><?php echo htmlspecialchars($announcement->title); ?></td>
                        <td><?php echo htmlspecialchars($announcement->content); ?></td>
                        <td><?php echo isset($announcement->type) && $announcement->type !== '' ? htmlspecialchars($announcement->type) : 'null'; ?></td>
                        <td><?php echo htmlspecialchars($announcement->target_audience); ?></td>
                        <td><?php echo htmlspecialchars($announcement->date); ?></td>
                        <td><?php echo htmlspecialchars(date('H:i', strtotime($announcement->time))); ?></td>
                        <!-- <td><?php echo htmlspecialchars($announcement->time); ?></td> -->
                        <td>
                            <a href="<?php echo URLROOT; ?>/Announcement/updateAnnouncement/<?php echo $announcement->id; ?>" class="btn btn-edit">Edit</a>
                            <a href="#" class="btn btn-delete" data-id="<?php echo $announcement->id; ?>" data-title="<?php echo htmlspecialchars($announcement->title); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Add form with the proper ID for delete action -->
        <form id="delete-form" method="POST" style="display: none;">
            <input type="hidden" name="id" id="delete-form-id">
        </form>

        <?php if ($data['totalPages'] > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                    <a href="<?php echo URLROOT; ?>/Announcement/viewAnnouncement/<?php echo $i; ?>" class="<?php echo $i == $data['page'] ? 'active' : ''; ?>" aria-label="Page <?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

        <div class="modal" id="delete-confirmation-modal" role="dialog" aria-labelledby="delete-modal-title" aria-hidden="true">
            <div class="modal-content">
                <h2 id="delete-modal-title">Confirm Deletion</h2>
                <p id="delete-modal-message">Are you sure you want to delete the announcement "<span id="delete-announcement-title"></span>"? This action cannot be undone.</p>
                <div class="modal-actions">
                    <button class="btn btn-cancel" id="delete-cancel" aria-label="Cancel deletion">Cancel</button>
                    <button class="btn btn-confirm-delete" id="delete-confirm" aria-label="Confirm deletion">Delete</button>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>No announcements found.</p>
    <?php endif; ?>
</div>
<script>
    window.totalAnnouncements = <?php echo $data['announcementTotal']; ?>;
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>