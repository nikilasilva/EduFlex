// Array of months
const months = [
    'January', 'February', 'March', 'April',
    'May', 'June', 'July', 'August',
    'September', 'October', 'November', 'December'
];

let currentMonthIndex = 0;

function changeMonth(direction) {
    if (direction === 'next') {
        currentMonthIndex = (currentMonthIndex + 1) % 12;
    } else {
        currentMonthIndex = (currentMonthIndex - 1 + 12) % 12;
    }

    // Update month title with fade effect
    const monthTitle = document.getElementById('monthTitle');
    monthTitle.classList.remove('fade-in');
    void monthTitle.offsetWidth; // Trigger reflow
    monthTitle.classList.add('fade-in');
    monthTitle.textContent = months[currentMonthIndex];

    // Add fade effect to table
    const tableBody = document.getElementById('attendanceData');
    tableBody.classList.remove('fade-in');
    void tableBody.offsetWidth; // Trigger reflow
    tableBody.classList.add('fade-in');

    // You can fetch and update attendance data for the selected month here
    // For now, we'll just keep the same data
}

// Optional: Disable previous button when on January
function updateNavigationButtons() {
    const prevButton = document.getElementById('prevMonth');
    const nextButton = document.getElementById('nextMonth');
    
    prevButton.disabled = currentMonthIndex === 0;
    nextButton.disabled = currentMonthIndex === 11;
}

// Initialize the month title
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('monthTitle').textContent = months[currentMonthIndex];
    updateNavigationButtons();
});