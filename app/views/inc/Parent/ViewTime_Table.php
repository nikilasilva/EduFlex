<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<div class="aca-container">
    <h1>Student Timetable</h1>

    <form action="<?= URLROOT ?>/ViewTimeTable/timetables" method="POST" class="attendance-form" style="margin-bottom: 20px;">
      <label for="student_id">Enter Student ID:</label>
      <input type="text" name="student_id" id="student_id" value="<?= htmlspecialchars($data['studentId'] ?? '') ?>" required>
      <button type="submit" class="nav-btn">View Timetable</button>
    </form>

    <?php if (!empty($data['studentId'])): ?>
      <?php if (isset($data['timetables']) && is_array($data['timetables']) && !empty($data['timetables'])): ?>
        <table>
          <thead class="academic-table-header">
            <tr>
              <th class="academic-header-cell">Time</th>
              <th class="academic-header-cell">Monday</th>
              <th class="academic-header-cell">Tuesday</th>
              <th class="academic-header-cell">Wednesday</th>
              <th class="academic-header-cell">Thursday</th>
              <th class="academic-header-cell">Friday</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['timetables'] as $timeSlot => $days): ?>
              <tr>
                <td><?= htmlspecialchars($timeSlot) ?></td>
                <?php foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day): ?>
                  <td><?= isset($days[$day]) ? htmlspecialchars($days[$day]['subject']) : '-' ?></td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p style="text-align: center;">No timetable data found for this student.</p>
      <?php endif; ?>
    <?php else: ?>
      <p style="text-align: center;">Please enter a student ID to view the timetable.</p>
    <?php endif; ?>
  </div>
</div>