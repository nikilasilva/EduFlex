export function initTeacherSearch() {
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    const tableBody = document.getElementById('teachers-table-body');
    const teacherCount = document.querySelector('.teacher-count');
    
    if (!searchInput || !searchButton || !tableBody) {
        return;
    }

    const rows = Array.from(tableBody.getElementsByTagName('tr'));

    function filterTeachers() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;
        rows.forEach(row => {
            const fullName = row.cells[1].textContent.toLowerCase();
            if (searchTerm === '' || fullName.includes(searchTerm)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update count display
        if (teacherCount) {
            teacherCount.textContent = `Total Teachers: ${visibleCount}`;
        }
    }

    searchButton.addEventListener('click', function(e) {
        e.preventDefault();
        filterTeachers();
    });

    searchInput.addEventListener('input', filterTeachers);

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            filterTeachers();
        }
    });
}

// Optional: Auto-run when imported
document.addEventListener('DOMContentLoaded', initTeacherSearch);