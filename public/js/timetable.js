// public/js/timetable.js

export function setupTimetableSearch() {
    const form = document.querySelector('.class-timetable-form');
    const button = form.querySelector('.class-timetable-form-btn');

    button.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent form from submitting right away

        const classVal = document.getElementById('classSelect').value;
        const dayVal = document.getElementById('daySelect').value;
        const table = document.getElementById('timetableTable');
        const pagination = document.getElementById('pagination');
        const message = document.getElementById('selectionMessage');

        if (classVal && dayVal) {
            // Hide message and show table + pagination
            if (message) message.style.display = 'none';
            if (table) table.style.display = 'table';
            if (pagination) pagination.style.display = 'flex';

            // Call the AJAX function to fetch timetable data
            fetchTimetableData(classVal, dayVal);
        } else {
            // Show message and hide table + pagination
            if (table) table.style.display = 'none';
            if (pagination) pagination.style.display = 'none';
            if (message) {
                message.textContent = 'Please select both Class and Day to view the timetable.';
                message.style.display = 'block';
            }
        }
    });
}

/**
 * Fetch the timetable data from the server via AJAX (using fetch API)
 * @param {string} classVal - The selected class value
 * @param {string} dayVal - The selected day value
 */
function fetchTimetableData(classVal, dayVal) {
    // Construct the URL for AJAX request
    const url = `${window.location.origin}/EduFlex/Timetable/classTimetable`;
    console.log('Class ID:', classVal);
    console.log('Day:', dayVal);
    console.log('location:', url);
    
    // Make the AJAX request using Fetch API
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'  // Add this to help PHP detect AJAX requests
        },
        body: JSON.stringify({ classId: classVal, day: dayVal }),
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
        updateTimetableTable(data);
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
 */
function updateTimetableTable(data) {
    const table = document.getElementById('timetableTable');
    const tableBody = document.getElementById('timetableTableBody');
    const message = document.getElementById('selectionMessage');
    const headerElement = document.getElementById('timetableHeader');

    if (!tableBody) {
        console.error('timetableTableBody element not found');
        return;
    }

    tableBody.innerHTML = ''; // Clear existing rows

    // Update the header with selected class and day
    if (headerElement) {
        const classSelect = document.getElementById('classSelect');
        const classText = classSelect.options[classSelect.selectedIndex].text;
        const dayText = document.getElementById('daySelect').value;
        
        if (classSelect.value === 'all') {
            headerElement.textContent = `All Classes ${dayText === 'All' ? 'Weekly' : dayText} Timetable`;
        } else {
            headerElement.textContent = `${classText} ${dayText === 'All' ? 'Weekly' : dayText} Timetable`;
        }
        headerElement.style.display = 'block';
    }

    if (data && data.length > 0) {
        // Show the table and hide the message
        if (table) table.style.display = 'table';
        if (message) message.style.display = 'none';

        // Populate the table with data
        data.forEach(item => {
            const row = `
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
            message.textContent = 'No timetable available for this class and day.';
            message.style.display = 'block';
        }
    }
}