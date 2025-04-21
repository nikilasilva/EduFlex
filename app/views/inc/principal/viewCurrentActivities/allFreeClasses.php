<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>


<div class="current-activities-container">
    <main>
        <div class="current-activity-content">
        <h1>All Free Classes</h1>
        <div class="search-bar">
            <input type="text" placeholder="Search by class" id="search-input">
            <button id="search-button">SEARCH</button>
        </div>
        <?php if (isset($message)): ?>
                <p><?php echo $message; ?></p>
        <?php endif; ?>
        <table class="free-classes-table">
            <thead>
            <tr>
                <th>Class</th>
                <th>Subject</th>
                <th>Period</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody id="table-body">
            <?php foreach ($data['freeClasses'] as $class): ?>
            <tr>
                <td><?= $class['className'] ?></td>
                <td><?= $class['subjectName'] ?></td>
                <td><?= $class['periodName'] ?></td>
                <td>
                <a href="<?php echo URLROOT ?>/CurrentActivities/showAvailableTeachers?subjectId=<?= $class['subjectId'] ?>&periodId=<?= $class['periodId'] ?>&day=<?= $class['day'] ?>">Assign</a>
                </td>
            </tr>
            <?php endforeach; ?>        
            </tbody>
        </table>
        </div>
    </main>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
