<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Parent Details</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/daily_activities.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="container">
            <h1>Update Parent Details</h1>

      <!-- Error message at the top -->
<div id="formError" class="form-error-message" style="display:none;"></div>

        <form id="editParentForm" action="<?php echo URLROOT; ?>/Admin/editParent/<?php echo $data['parents']->regNo; ?>" method="POST" novalidate>

            <div class="form-group">
                <label for="regNo">User Reg (Parent):</label>
                <input type="number" name="regNo" id="regNo" value="<?php echo htmlspecialchars($data['parents']->regNo); ?>" required>
            </div>

            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" name="fullName" id="fullName" value="<?php echo htmlspecialchars($data['parents']->fullName); ?>" required>
            </div>

            <div class="form-group">
                <label for="nameWithInitial">Name with Initials:</label>
                <input type="text" name="nameWithInitial" id="nameWithInitial" value="<?php echo htmlspecialchars($data['parents']->nameWithInitial); ?>" required>
            </div>

            <div class="form-group">
                <label for="NIC">NIC (Parent):</label>
                <input type="text" name="NIC" id="NIC" value="<?php echo htmlspecialchars($data['parents']->NIC); ?>" required>
                <div class="error-message" id="NICError"></div>
            </div>

            <div class="form-group">
                <label for="relationship">relationship :</label>
                <select name="relationship" id="relationship" required>
                    <option value="">-- Select relationship --</option>
                    <option value="Mother" <?php echo ($data['parents']->relationship === 'Mother') ? 'selected' : ''; ?>>Mother</option>
                    <option value="Father" <?php echo ($data['parents']->relationship === 'Father') ? 'selected' : ''; ?>>Father</option>
                    <option value="Guardian" <?php echo ($data['parents']->relationship === 'Guardian') ? 'selected' : ''; ?>>Guardian</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button><br><br>
            <a href="<?php echo URLROOT; ?>/Admin/viewParents" class="btn btn-secondary">Back to List</a>

        </form>

        <!-- Validation Script -->
        <script>
        document.getElementById('editParentForm').addEventListener('submit', function(event) {
            let isValid = true;

            // Clear previous errors
            document.getElementById('formError').style.display = 'none';
            document.getElementById('NICError').textContent = '';

            const regNo = document.getElementById('regNo').value.trim();
            const fullName = document.getElementById('fullName').value.trim();
            const nameWithInitial = document.getElementById('nameWithInitial').value.trim();
            const NIC = document.getElementById('NIC').value.trim();
            const Relationship = document.getElementById('Relationship').value.trim();

            // Check all fields filled
            if (!regNo || !fullName || !nameWithInitial || !NIC || !Relationship) {
                document.getElementById('formError').style.display = 'block';
                document.getElementById('formError').textContent = 'Required field is not filled, please check.';
                isValid = false;
            }

            // Validate NIC length
            if (NIC && !(NIC.length === 10 || NIC.length === 12)) {
                document.getElementById('NICError').textContent = 'Incorrect NIC.';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
        </script>

        <style>
        .form-error-message {
            color: red;
            font-size: 1rem;
            margin-bottom: 10px;
        }
        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        </style>

                
           
        </div>
    </div>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>
