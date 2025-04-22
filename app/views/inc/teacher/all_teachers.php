<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>

<div class="all-teachers-container">

    <h1>All Teachers</h1>

    <div class="search-bar all-teachers-search-bar">
        <input type="text" placeholder="Search by name" id="search-input">
        <button id="search-button">SEARCH</button>
    </div>
    
    <?php if (isset($data['message'])): ?>
        <p><?php echo $data['message']; ?></p>
    <?php else: ?>

        <!-- Display teacher count -->
        <div class="teacher-count-wrapper">
            <p class="teacher-count">Total Teachers: <?php echo $data['teacherCount']; ?></p>
        </div>

        <table id="teachers-table">
        <thead>
            <tr>
                <th>Reg No</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Mobile No</th>
                <th>Subjects</th>
                <th>Class Name</th>
            </tr>
        </thead>
        <tbody id="teachers-table-body">
            <?php foreach ($data['teachers'] as $teacher): ?>
                <tr>
                    <td><?php echo $teacher['regNo']; ?></td>
                    <td><?php echo $teacher['fullName']; ?></td>
                    <td><?php echo $teacher['email']; ?></td>
                    <td><?php echo $teacher['mobileNo']; ?></td>
                    <td><?php echo $teacher['subjects'] ? $teacher['subjects'] : 'None assigned'; ?></td>
                    <td><?php echo $teacher['className'] ? $teacher['className'] : 'None assigned'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>
<?php require APPROOT.'/views/inc/footer.php'; ?>