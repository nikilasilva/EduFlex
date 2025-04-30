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

            <!-- Flash message -->
            <?php if(isset($data['message']) && !empty($data['message'])): ?>
            <div id="flash-message" class="alert alert-success">
                <?php echo $data['message']; ?>
            </div>
            <?php endif; ?>
            
            <?php if(isset($data['errors']['general']) && !empty($data['errors']['general'])): ?>
                <div id="flash-message" class="alert alert-danger">
                    <?php echo $data['errors']['general']; ?>
                </div>
            <?php endif; ?>

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
                                <form action="<?= URLROOT ?>/CurrentActivities/sendAssignmentEmail" method="POST">
                                    <input type="hidden" name="teacherId" value="<?= $teacher->teacherId ?>">
                                    <input type="hidden" name="teacherName" value="<?= $teacher->fullName ?>">
                                    <input type="hidden" name="teacherEmail" value="<?= $teacher->email ?>">
                                    <input type="hidden" name="subjectId" value="<?= $data['subjectId'] ?>">
                                    <input type="hidden" name="periodId" value="<?= $data['periodId'] ?>">
                                    <input type="hidden" name="day" value="<?= $data['day'] ?>">
                                    <?php if(isset($data['classDetails'])): ?>
                                    <input type="hidden" name="className" value="<?= $data['classDetails']->className ?>">
                                    <input type="hidden" name="subjectName" value="<?= $data['classDetails']->subjectName ?>">
                                    <input type="hidden" name="periodName" value="<?= $data['classDetails']->periodName ?>">
                                    <input type="hidden" name="roomNumber" value="<?= $data['classDetails']->roomNumber ?>">
                                    <?php endif; ?>
                                    <button type="submit" class="btn btn-email">Send Email</button>
                                </form>
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