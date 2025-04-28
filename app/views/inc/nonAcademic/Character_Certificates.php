<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<div class="layout">
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

    <div class="attendance-container">
        <h1>Student Requested Character Certificates</h1>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Certificate ID</th>
                    <th>Full Name</th>
                    <th>Student ID</th>
                    <th>Date of Birth</th>
                    <th>Reason</th>
                    <th>slip</th>
                    <th>Status</th> <!-- New column -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['characterCertificates'])): ?>
                    <?php foreach ($data['characterCertificates'] as $characterCertificates): ?>
                        <tr>
                            <td><?php echo $characterCertificates->certificate_id; ?></td>
                            <td><?php echo $characterCertificates->full_name; ?></td>
                            <td><?php echo $characterCertificates->student_id; ?></td>
                            <td><?php echo $characterCertificates->date_of_birth; ?></td>
                            <td><?php echo $characterCertificates->reason; ?></td>
                            <td><?php echo $characterCertificates->slip; ?></td>
                            <td>
                                <?php if ($characterCertificates->status == 0): ?>
                                    <form method="post" action="<?php echo URLROOT; ?>/NonAcademic/markCharacterCertificateComplete/<?php echo $characterCertificates->certificate_id; ?>" onsubmit="return showCharacterProcessingMessage(this);">
                                        <button id="charSubmitBtn_<?php echo $characterCertificates->certificate_id; ?>" type="submit" style="padding: 6px 12px; background-color:rgb(255, 0, 0); color: white; border: none; border-radius: 4px;">
                                            Allocate                      </button>
                                        <span id="charStatusMsg_<?php echo $characterCertificates->certificate_id; ?>" style="margin-left:10px; color:green;"></span>
                                    </form>

                                    <script>
                                        function showCharacterProcessingMessage(form) {
                                            const id = form.action.split('/').pop(); // Extract certificate_id
                                            const btn = document.getElementById('charSubmitBtn_' + id);
                                            // const msg = document.getElementById('charStatusMsg_' + id);

                                            btn.disabled = true;
                                            btn.innerText = "Processing...";
                                            // msg.innerText = "Please wait, sending email and updating status...";

                                            return true; // Allow form submission
                                        }
                                    </script>

                                <?php else: ?>
                                    <button onclick="alert('The email has already been sent to the student.'); return false;" style="padding: 6px 12px; background-color: rgb(59, 143, 57); color: white; border: none; border-radius: 4px; ">
                                        Allocated
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No leaving certificates found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="<?php echo URLROOT; ?>/NonAcademic/allocatedCharacterCertificatesView">
            <button class="byn btn-primary">
                View Allocated Time
            </button>
        </a>

    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>