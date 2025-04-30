<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="assign-class-teachers-container">
    <h1>Manage Class Teachers</h1>

    <?php if(!empty($data['success'])): ?>
        <div id="flash-message" class="alert alert-success">
            <?php echo $data['success']; ?>
        </div>
    <?php endif; ?>

    <?php if(!empty($data['error'])): ?>
        <div id="flash-message" class="alert alert-danger">
            <?php echo $data['error']; ?>
        </div>
    <?php endif; ?>

    <!-- Academic Year Filter -->
    <div class="filter-dropdowns">
        <select id="academicYearAssign">
        <option value="">Select Academic Year</option>
        <?php if (empty($data['academic_year'])): ?>
            <option value="" disabled>No academic years available</option>
        <?php else: ?>
            <?php foreach ($data['academic_year'] as $academicYear): ?>
                <option value="<?php echo htmlspecialchars($academicYear->academicYear); ?>"
                    <?php echo $data['selected_academic_year'] == $academicYear->academicYear ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($academicYear->academicYear); ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    </div>

    <?php if (!empty($data['selected_academic_year'])): ?>
        <?php if (!empty($data['classes'])): ?>
            <h2>Academic Year: <?php echo htmlspecialchars($data['selected_academic_year']); ?></h2>
            <table id="cTeacher-assign-table">
                <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Academic Year</th>
                        <th>Current Teacher</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="cTeacher-assign-table-body">
                    <?php foreach ($data['classes'] as $class): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($class['className']); ?></td>
                            <td><?php echo htmlspecialchars($class['academicYear']); ?></td>
                            <td class="<?php echo $class['teacherName'] == 'None' ? 'no-teacher' : ''; ?>">
                                <?php echo htmlspecialchars($class['teacherName']); ?>
                            </td>
                            <td>
                                <button class="btn btn-edit" 
                                        data-class-id="<?php echo $class['classId']; ?>" 
                                        data-class-name="<?php echo htmlspecialchars($class['className']); ?>">
                                    Assign
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No Classes Available for the selected academic year.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>Please select an academic year to view classes.</p>
    <?php endif; ?>

    <!-- Modal for Assigning Teacher -->
    <div class="modal" id="assignModal" role="dialog" aria-labelledby="assign-modal-title" aria-hidden="true">
        <div class="modal-content">
            <h2 id="assign-modal-title">Assign Teacher</h2>
            <p id="assign-modal-message">Assign a teacher to <span id="modalClassName"></span>:</p>
            <form id="assign-form" method="POST" action="<?php echo URLROOT; ?>/teacher/assignClassTeacher">
                <input type="hidden" id="modalClassId" name="classId">
                <?php if (!empty($data['selected_academic_year'])): ?>
                    <input type="hidden" name="academicYear" value="<?php echo htmlspecialchars($data['selected_academic_year']); ?>">
                <?php endif; ?>
                <?php if (empty($data['teachers'])): ?>
                    <p>No unassigned teachers available.</p>
                <?php else: ?>
                    <select id="teacherSelect" name="teacherId">
                        <option value="">Select a teacher</option>
                        <?php foreach ($data['teachers'] as $teacher): ?>
                            <option value="<?php echo htmlspecialchars($teacher->teacher_id); ?>">
                                <?php echo htmlspecialchars($teacher->teacher_name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <div class="modal-actions">
                    <button type="button" class="btn btn-cancel cancel-btn" aria-label="Cancel assignment">Cancel</button>
                    <button type="submit" class="btn btn-confirm" aria-label="Confirm assignment">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>