<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>

<div class="layout">
    <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

    <div class="attendance-container">
        <h1>Student Leaving Certificates</h1>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Certificate ID</th>
                    <th>Full Name</th>
                    <th>Student ID</th>
                    <th>Date of Birth</th>
                    <th>Admission Date</th>
                    <th>Reason for Leaving</th>
                    <th>Status</th> <!-- New column -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['LeavingCertificates'])): ?>
                    <?php foreach ($data['LeavingCertificates'] as $certificate): ?>
                        <tr>
                            <td><?php echo $certificate->certificate_id; ?></td>
                            <td><?php echo $certificate->full_name; ?></td>
                            <td><?php echo $certificate->student_id; ?></td>
                            <td><?php echo $certificate->DOB; ?></td>
                            <td><?php echo $certificate->Admission_date; ?></td>
                            <td><?php echo $certificate->Reason; ?></td>
                            <td>
                                <?php if ($certificate->status == 0): ?>
                                    <form method="post" action="<?php echo URLROOT; ?>/NonAcademic/markCertificateComplete/<?php echo $certificate->certificate_id; ?>" onsubmit="return showProcessingMessage(this);">
                                        <button id="submitBtn_<?php echo $certificate->certificate_id; ?>" type="submit" style="padding: 6px 12px; background-color:rgb(255, 0, 0); color: white; border: none; border-radius: 4px;">
                                        Allocate
                                        </button>
                                        <span id="statusMsg_<?php echo $certificate->certificate_id; ?>" style="margin-left:10px; color:green;"></span>
                                    </form>

                                    <script>
                                        function showProcessingMessage(form) {
                                            const id = form.action.split('/').pop(); // Extract certificate_id
                                            const btn = document.getElementById('submitBtn_' + id);
                                            // const msg = document.getElementById('statusMsg_' + id);

                                            btn.disabled = true;
                                            btn.innerText = "Processing...";
                                            // msg.innerText = "Please wait, sending email and updating status...";

                                            return true; // Allow form to submit
                                        }
                                    </script>

                                <?php else: ?>
                                    <button onclick="alert('The email has already been sent to the student.'); return false;" style="padding: 6px 12px; background-color: rgb(59, 143, 57); color: white; border: none; border-radius: 4px; ">
                                    Allocated 
                                    </button> <?php endif; ?>
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
        <a href="<?php echo URLROOT; ?>/NonAcademic/allocatedleavingCertificatesView">
            <button class="byn btn-primary">
            View Allocated Time
            </button>
        </a>

    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>