<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="upload-users-container">
    <h1>Upload Users via CSV</h1>
    <div class="upload-form">
        <p>Upload a CSV file with columns: <p class="users-csv-headings"> email, mobileNo, address, fullName, nameWithInitial, dob, gender, religion, role, student_id, classId, guardianRegNo, occupation, relationship</p>
            <br> Passwords will be automatically generated as username + "123".
            <br>For students, include studentId, classId, guardianRegNo
            <br>For parents, include occupation and relationship (Father, Mother, or Guardian)</p>
        <form id="upload-csv-form" action="<?php echo URLROOT; ?>/SuperAdmin/uploadResult" method="POST" enctype="multipart/form-data">
            <input type="file" id="csv-file" name="csv_file" accept=".csv">
            <button type="submit" id="upload-csv-button">Upload CSV</button>
        </form>
        <p id="upload-message"></p>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>