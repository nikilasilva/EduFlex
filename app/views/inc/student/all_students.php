<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sidebar.php'; ?>

<div class="all-students-container">

    <h1>All Students</h1>

    <!-- Search and Filter Section -->
    <div class="search-filter-bar">
        <div class="search-bar all-students-search-bar">
            <input type="text" placeholder="Search by name" id="search-input">
            <button id="search-button">SEARCH</button>
        </div>
        
        <div class="filter-dropdowns">
            <select id="classSelectStudents">
            <option value="">All Classes</option>
            <?php foreach ($data['classes'] as $class): ?>
                <option value="<?php echo $class->className ?>">
                    <?php echo $class->className ?>
                </option>
                <?php endforeach; ?>
            </select>
                
            <select id="gradeSelectStudents">
            <option value="">All Grades</option>
            <?php foreach ($data['grades'] as $grade): ?>
                <option value="<?php echo $grade->grade ?>">
                    Grade <?php echo $grade->grade ?>
                </option>
                <?php endforeach; ?>
            </select>
                    
            <select id="religionSelectStudents">
            <option value="">All Religions</option>
            <?php foreach ($data['religions'] as $religion): ?>
                <option value="<?php echo $religion->religion ?>">
                    <?php echo $religion->religion ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Display student count -->
        <div class="student-count-wrapper">
            <p class="student-count">Total Students: <?php echo $data['studentCount']; ?></p>
        </div>
    </div>
    
    <?php if (isset($data['message'])): ?>
        <p><?php echo $data['message']; ?></p>
    <?php else: ?>


        <table id="students-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Class</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Religion</th>
                    <th>Parent</th>
                    <th>Parent Mobile No</th>
                </tr>
            </thead>
            <tbody id="students-table-body">
                <?php foreach ($data['students'] as $student): ?>
                    <tr>
                        <td><?php echo $student['studentId']; ?></td>
                        <td><?php echo $student['fullName']; ?></td>
                        <td><?php echo $student['className']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td><?php echo $student['mobileNo']; ?></td>
                        <td><?php echo $student['religion']; ?></td>
                        <td><?php echo $student['parentName']; ?></td>
                        <td><?php echo $student['parentMobileNo']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require APPROOT.'/views/inc/footer.php'; ?>