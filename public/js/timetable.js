// public/js/timetable.js

export function setupTimetableSearch(isTeacher = false) {
    const formClass = isTeacher ? '.teacher-timetable-form' : '.class-timetable-form';
    const buttonClass = isTeacher ? '.teacher-timetable-form-btn' : '.class-timetable-form-btn';
    const selectId = isTeacher ? 'teacherSelect' : 'classSelect';
    const endpoint = isTeacher ? 'teacherTimetable' : 'classTimetable';
    
    const form = document.querySelector(formClass);
    const button = form.querySelector(buttonClass);

    button.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent form from submitting right away

        const selectVal = document.getElementById(selectId).value;
        const dayVal = document.getElementById('daySelect').value;
        const table = document.getElementById('timetableTable');
        const message = document.getElementById('selectionMessage');

        if (selectVal && dayVal) {
            // Hide message and show table
            if (message) message.style.display = 'none';
            if (table) table.style.display = 'table';

            // Call the AJAX function to fetch timetable data
            fetchTimetableData(selectVal, dayVal, endpoint);
        } else {
            // Show message and hide table
            if (table) table.style.display = 'none';
            if (message) {
                message.textContent = `Please select both ${isTeacher ? 'Teacher' : 'Class'} and Day to view the timetable.`;
                message.style.display = 'block';
            }
        }
    });
}

/**
 * Fetch the timetable data from the server via AJAX (using fetch API)
 * @param {string} selectVal - The selected class or teacher value
 * @param {string} dayVal - The selected day value
 * @param {string} endpoint - The controller endpoint (classTimetable or teacherTimetable)
 */
function fetchTimetableData(selectVal, dayVal, endpoint) {
    // Construct the URL for AJAX request
    const url = `${window.location.origin}/EduFlex/Timetable/${endpoint}`;
    console.log('Select ID:', selectVal);
    console.log('Day:', dayVal);
    console.log('location:', url);
    
    // Determine payload based on endpoint
    const payload = endpoint === 'teacherTimetable' 
        ? { teacherId: selectVal, day: dayVal }
        : { classId: selectVal, day: dayVal };

    // Make the AJAX request using Fetch API
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(payload),
    })
    .then(response => response.text())
    .then(text => {
        // Handle potential NULL responses
        if (text.includes('NULL')) {
            console.log('Response contained NULL:', text);
            return [];
        }
        
        // Try to parse JSON only if we have valid text
        try {
            if (text && text.trim()) {
                return JSON.parse(text);
            } else {
                return [];
            }
        } catch (e) {
            console.error('JSON parse error:', e);
            console.log('Response was:', text);
            return [];
        }
    })
    .then(data => {
        // Process the response and update the table
        console.log('Timetable Data:', data);
        updateTimetableTable(data, endpoint);
    })
    .catch(error => {
        console.error('Error fetching timetable data:', error);
        // Show error message
        const message = document.getElementById('selectionMessage');
        if (message) {
            message.textContent = 'Error loading timetable data. Please try again later.';
            message.style.display = 'block';
        }
    });
}

/**
 * Update the timetable table with the data received from the server
 * @param {Array} data - Array of timetable entries
 * @param {string} endpoint - The controller endpoint (classTimetable or teacherTimetable)
 */
function updateTimetableTable(data, endpoint) {
    const table = document.getElementById('timetableTable');
    const tableBody = document.getElementById('timetableTableBody');
    const message = document.getElementById('selectionMessage');
    const headerElement = document.getElementById('timetableHeader');

    if (!tableBody) {
        console.error('timetableTableBody element not found');
        return;
    }

    // Check if both selections are made
    const selectId = endpoint === 'teacherTimetable' ? 'teacherSelect' : 'classSelect';
    const selectElement = document.getElementById(selectId);
    const selectVal = selectElement ? selectElement.value : '';
    const dayVal = document.getElementById('daySelect')?.value || '';

    // Only show header if BOTH are selected
    if (headerElement) {
        if (selectVal && dayVal) {
            const displayDay = dayVal === 'All' ? 'Weekly' : dayVal;
            headerElement.textContent = `${displayDay} Timetable`;
            headerElement.style.display = 'block';
        } else {
            headerElement.style.display = 'none'; // ❌ Hide if missing selection
        }
    }

    if (data && data.length > 0) {
        // Show the table and hide the message
        if (table) table.style.display = 'table';
        if (message) message.style.display = 'none';

        // Populate the table with data based on endpoint type
        data.forEach(item => {
            const row = endpoint === 'teacherTimetable' 
                ? `
                    <tr>
                        <td>${item.periodName || 'N/A'}</td>
                        <td>${item.startTime || 'N/A'}</td>
                        <td>${item.endTime || 'N/A'}</td>
                        <td>${item.subjectName || 'N/A'}</td>
                        <td>${item.className || 'N/A'}</td>
                        <td>${item.roomNumber || 'N/A'}</td>
                    </tr>
                `
                : `
                    <tr>
                        <td>${item.periodName || 'N/A'}</td>
                        <td>${item.startTime || 'N/A'}</td>
                        <td>${item.endTime || 'N/A'}</td>
                        <td>${item.subjectName || 'N/A'}</td>
                        <td>${item.teacherName || 'N/A'}</td>
                        <td>${item.roomNumber || 'N/A'}</td>
                    </tr>
                `;
            tableBody.innerHTML += row;
        });
    } else {
        // Hide the table and show the message
        if (table) table.style.display = 'none';
        if (message) {
            message.textContent = 'No timetable available for this selection.';
            message.style.display = 'block';
        }
    }
}