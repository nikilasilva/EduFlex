<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>

<!-- <?php $edit_id = isset($_GET['edit_id']) ? $_GET['edit_id'] : null; ?> -->
<div class="aca-container container">
<h1>Leaving Certificates</h1>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Reason</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($leavingCertificates)): ?>
            <?php foreach ($leavingCertificates as $cert): ?>
                <tr>
                <?php if (isset($edit_id) && $edit_id == $cert->certificate_id): ?>
                        <form method="post" action="<?= URLROOT ?>/LeavingCertificate/ViewLeavingCertificates">
                            <td><?= htmlspecialchars($cert->certificate_id) ?>
                                <input type="hidden" name="certificate_id" value="<?= $cert->certificate_id ?>">
                            </td>
                            <!-- <td><input type="text" name="full_name" value="<?= htmlspecialchars($cert->full_name) ?>"></td>
                            <td><input type="date" name="DOB" value="<?= htmlspecialchars($cert->DOB) ?>"></td>
                            <td><input type="date" name="Admission_date" value="<?= htmlspecialchars($cert->Admission_date) ?>"></td> -->
                            <td><input type="text" name="student_id" value="<?= htmlspecialchars($cert->student_id) ?>"></td>
                            <td><input type="text" name="Reason" value="<?= htmlspecialchars($cert->Reason) ?>"></td>
                            
                            <!-- <td>
                                <button type="submit">Save</button>
                                <a href="<?= URLROOT ?>/LeavingCertificate">Cancel</a>
                            </td> -->
                        </form>
                    <?php else: ?>
                        <!-- <td><?= htmlspecialchars($cert->certificate_id) ?></td>
                        <td><?= htmlspecialchars($cert->full_name) ?></td>
                        <td><?= htmlspecialchars($cert->DOB) ?></td>
                        <td><?= htmlspecialchars($cert->Admission_date) ?></td> -->
                        <td><?= htmlspecialchars($cert->student_id) ?></td>
                        <td><?= htmlspecialchars($cert->Reason) ?></td>
                        
                        <td>
                            
                            <a class="btn btn-edit" href="<?= URLROOT ?>/LeavingCertificate/update/<?=htmlspecialchars($cert->certificate_id)?>">Edit</a>
                            <a class="btn btn-delete" href="<?= URLROOT ?>/LeavingCertificate/delete/<?= $cert->certificate_id ?>" onclick="return confirm('Are you sure to delete?')">Delete</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">No leaving certificates found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
        </div>

<?php require APPROOT.'/views/inc/footer.php'; ?>
