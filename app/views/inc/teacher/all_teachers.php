<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<div class="all-teachers-container">
    <h1>All Teachers</h1>

    <!-- Flash message -->
    <?php if (isset($data['message']) && !empty($data['message'])): ?>
        <div id="flash-message" class="alert alert-info">
            <?php echo htmlspecialchars($data['message']); ?>
        </div>
    <?php endif; ?>
    
    <div class="search-filter-bar">
        <div class="search-bar all-teachers-search-bar">
            <input type="text" placeholder="Search by name" id="search-input">
            <button id="search-button">SEARCH</button>
        </div>

        <div class="filter-dropdowns">
            <select id="gradeSelectTeacher">
                <option value="">All Grades</option>
                <?php foreach ($data['grades'] as $grade): ?>
                    <option value="<?php echo $grade->grade ?>">
                        Grade <?php echo $grade->grade ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select id="subjectSelectTeacher">
                <option value="">All Subjects</option>
                <?php foreach ($data['subjects'] as $subject): ?>
                    <option value="<?= htmlspecialchars($subject->subjectName) ?>">
                        <?= htmlspecialchars($subject->subjectName) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <?php if (!empty($data['teachers'])): ?>
        <!-- Display teacher count -->
        <div class="teacher-count-wrapper">
            <p class="teacher-count">Showing: <?php echo $data['teacherCount']; ?> Result(s) out of <?php echo $data['teacherTotal']; ?> Total</p>
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
                        <td><?php echo htmlspecialchars($teacher['regNo']); ?></td>
                        <td><?php echo htmlspecialchars($teacher['fullName']); ?></td>
                        <td><?php echo htmlspecialchars($teacher['email']); ?></td>
                        <td><?php echo htmlspecialchars($teacher['mobileNo']); ?></td>
                        <td><?php echo htmlspecialchars($teacher['subjects'] ? $teacher['subjects'] : 'None assigned'); ?></td>
                        <td><?php echo htmlspecialchars($teacher['className'] ? $teacher['className'] : 'None assigned'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php if ($data['totalPages'] > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                    <a href="<?php echo URLROOT; ?>/Teacher/showAllTeachers/<?php echo $i; ?>" class="<?php echo $i == $data['page'] ? 'active' : ''; ?>" aria-label="Page <?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <p>No teachers found.</p>
    <?php endif; ?>
</div>

<script>
    window.totalTeachers = <?php echo $data['teacherTotal']; ?>;
</script>
<?php require APPROOT.'/views/inc/footer.php'; ?>