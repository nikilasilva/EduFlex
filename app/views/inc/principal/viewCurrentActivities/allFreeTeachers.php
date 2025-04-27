<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="current-activities-container">
    <main>
        <div class="current-activity-content">
            <h1>All Free Teachers</h1>
            <!-- <div class="search-bar">
                <input type="text" placeholder="Search by class" id="search-input">
                <button id="search-button">SEARCH</button>
            </div> -->
            <?php if (isset($data['message'])): ?>
                <p><?php echo $data['message']; ?></p>
            <?php elseif (empty($data['availableTeachers'])): ?>
                <p>No available teachers found for this slot.</p>
            <?php else: ?>
                <table class="free-classes-table">
                    <thead>
                        <tr>
                            <th>Teacher ID</th>
                            <th>Name</th>
                            <th>Mobile No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php foreach ($data['availableTeachers'] as $teacher): ?>
                        <tr>
                            <td><?= $teacher->teacher_id ?></td>
                            <td><?= $teacher->fullName ?></td>
                            <td><?= $teacher->mobileNo ?></td>
                            <td>
                                <button class="btn btn-edit" onclick="confirmAssignment(<?= $teacher->teacherId ?>)">Confirm</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>
</div>
<script>
    function confirmAssignment(teacherId) {
        alert("Teacher assigned successfully!");
        window.location.href = "<?php echo URLROOT ?>/CurrentActivities/allFreeClasses";
    }
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>