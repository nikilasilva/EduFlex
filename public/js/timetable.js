export function setupTimetableSearch() {
    document.querySelector('button').addEventListener('click', function () {
        const classVal = document.getElementById('classSelect').value;
        const dayVal = document.getElementById('daySelect').value;
        const table = document.getElementById('timetableTable');
        const pagination = document.getElementById('pagination');
        const message = document.getElementById('selectionMessage');

        if (classVal && dayVal) {
            table.style.display = 'table';
            pagination.style.display = 'flex';
            message.style.display = 'none';
        } else {
            table.style.display = 'none';
            pagination.style.display = 'none';
            message.textContent = 'Please select both Class and Day to view the timetable.';
            message.style.display = 'block';
        }
    });
}
