<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sidebar.php'; ?>

<div class="all-students-container container">
    <h1>All Students</h1>

    <!-- Flash message -->
    <?php if (isset($data['message']) && !empty($data['message'])): ?>
        <div id="flash-message" class="alert alert-info">
            <?php echo $data['message']; ?>
        </div>
    <?php endif; ?>

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
        </div>

        <!-- Display student count -->
        <div class="student-count-wrapper">
            <p class="student-count">Showing: <?php echo $data['studentCount']; ?> Result(s) out of <?php echo $data['studentTotal']; ?> Total</p>
        </div>
    </div>
    
    <?php if (!empty($data['students'])): ?>
        <table id="students-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Class</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Gender</th>
                    <th>Parent</th>
                    <th>Parent Mobile No</th>
                </tr>
            </thead>
            <tbody id="students-table-body">
                <?php foreach ($data['students'] as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['studentId']); ?></td>
                        <td><?php echo htmlspecialchars($student['fullName']); ?></td>
                        <td><?php echo htmlspecialchars($student['className']); ?></td>
                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                        <td><?php echo htmlspecialchars($student['mobileNo']); ?></td>
                        <td><?php echo htmlspecialchars($student['gender']); ?></td>
                        <td><?php echo htmlspecialchars($student['parentName']); ?></td>
                        <td><?php echo htmlspecialchars($student['parentMobileNo']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php if ($data['totalPages'] > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                    <a href="<?php echo URLROOT; ?>/Student/showAllStudents/<?php echo $i; ?>" class="<?php echo $i == $data['page'] ? 'active' : ''; ?>" aria-label="Page <?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <p>No students found.</p>
    <?php endif; ?>
</div>

<script>
    window.totalStudents = <?php echo $data['studentTotal']; ?>;
</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>