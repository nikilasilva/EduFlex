<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/attendance.css">
</head>

<body>
    <div class="layout">
        <!-- Sidebar -->
        <?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

        <!-- Main content -->
        <div class="attendance-container">
            <h1>Record Teachers Attendencee</h1>

            <!-- Attendance form -->
            <form action="<?php echo URLROOT; ?>/nonAcademic/SubmitTeachersAttendenceeForm" method="POST">

                <table>
                    <thead>
                        <tr>
                            <th>Teacher Name</th>
                            <th>teacher ID</th>
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        

                    </tbody>
                </table>

                <br></br>
                <button type="submit" class="btn btn-primary">Submit Attendance</button><br></br>
                <button type="submit" class="btn btn-primary">View Attendance</button>
            </form>
        </div>
    </div>

    <script>
        // Function to generate table rows with checkboxes

        function generateTable(rows) {
            const tableBody = document.getElementById('tableBody');
            for (let i = 1; i <= rows; i++) {
                const row = document.createElement('tr');

                // Teacher NAME column

                // Teacher ID column
                const cellNumber = document.createElement('td');
                cellNumber.textContent = i;
                row.appendChild(cellNumber);

                // Attendance column with checkboxes
                const cellCheckbox = document.createElement('td');
                cellCheckbox.innerHTML = `
            <label>
                <input type="radio" name="attendance[${i}]" value="present" required> Present
            </label>
            <label>
                <input type="radio" name="attendance[${i}]" value="absent" required> Absent
            </label>
        `;
                row.appendChild(cellCheckbox);

                // Append the row to the table body
                tableBody.appendChild(row);
            }
        }



        // -------------------------

        // function generateTable(rows) {
        //     const tableBody = document.getElementById('tableBody');
        //     for (let i = 1; i <= rows; i++) {
        //         const row = document.createElement('tr');

        //         // Row number column
        //         const cellNumber = document.createElement('td');
        //         cellNumber.textContent = i;
        //         row.appendChild(cellNumber);

        //         // Checkbox column
        //         const cellCheckbox = document.createElement('td');
        //         cellCheckbox.innerHTML = `
        //             <label>
        //                 <input type="checkbox" id="row${i}checkbox1" onclick="toggleRowCheckbox('row${i}checkbox2', this)"> present
        //             </label>
        //             <label>
        //                 <input type="checkbox" id="row${i}checkbox2" onclick="toggleRowCheckbox('row${i}checkbox1', this)"> absent
        //             </label>
        //         `;
        //         row.appendChild(cellCheckbox);

        //         // Append the row to the table body
        //         tableBody.appendChild(row);
        //     }
        // }
        // ----------------------------
        // Function to toggle checkboxes in the same row
        function toggleRowCheckbox(otherCheckboxId, currentCheckbox) {
            const otherCheckbox = document.getElementById(otherCheckboxId);
            if (currentCheckbox.checked) {
                otherCheckbox.checked = false;
            }
        }

        // Generate 5 rows in the table as an example
        generateTable(10);
    </script>

</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>