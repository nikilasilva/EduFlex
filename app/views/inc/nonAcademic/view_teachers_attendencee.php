<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkbox Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Checkbox Table</h2>
    <table>
        <thead>
            <tr>
                <th>Row</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <!-- Rows will be dynamically generated -->
        </tbody>
    </table>

    <script>
        // Function to generate table rows with checkboxes
        function generateTable(rows) {
            const tableBody = document.getElementById('tableBody');
            for (let i = 1; i <= rows; i++) {
                const row = document.createElement('tr');

                // Row number column
                const cellNumber = document.createElement('td');
                cellNumber.textContent = i;
                row.appendChild(cellNumber);

                // Checkbox column
                const cellCheckbox = document.createElement('td');
                cellCheckbox.innerHTML = `
                    <label>
                        <input type="checkbox" id="row${i}checkbox1" onclick="toggleRowCheckbox('row${i}checkbox2', this)"> Option 1
                    </label>
                    <label style="margin-left: 20px;">
                        <input type="checkbox" id="row${i}checkbox2" onclick="toggleRowCheckbox('row${i}checkbox1', this)"> Option 2
                    </label>
                `;
                row.appendChild(cellCheckbox);

                // Append the row to the table body
                tableBody.appendChild(row);
            }
        }

        // Function to toggle checkboxes in the same row
        function toggleRowCheckbox(otherCheckboxId, currentCheckbox) {
            const otherCheckbox = document.getElementById(otherCheckboxId);
            if (currentCheckbox.checked) {
                otherCheckbox.checked = false;
            }
        }

        // Generate 5 rows in the table as an example
        generateTable(5);
    </script>
</body>

</html>