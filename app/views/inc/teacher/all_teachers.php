<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>

<div class="all-teachers-container">

    <h1>All Teachers</h1>

    <div class="search-bar">
        <input type="text" placeholder="Search by name" id="search-input">
        <button id="search-button">SEARCH</button>
    </div>
    
    <?php if (isset($data['message'])): ?>
        <p><?php echo $data['message']; ?></p>
    <?php else: ?>
            <table>
            <thead>
                <tr>
                    <th>Reg No</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Subjects</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['teachers'] as $teacher): ?>
                    <tr>
                        <td><?php echo $teacher['regNo']; ?></td>
                        <td><?php echo $teacher['fullName']; ?></td>
                        <td><?php echo $teacher['email']; ?></td>
                        <td><?php echo $teacher['mobileNo']; ?></td>
                        <td><?php echo $teacher['subjects'] ? $teacher['subjects'] : 'None assigned'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>
<?php require APPROOT.'/views/inc/footer.php'; ?>