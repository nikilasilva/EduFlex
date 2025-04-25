export function initTeacherSearch() {
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    const tableBody = document.getElementById('teachers-table-body');
    const teacherCount = document.querySelector('.teacher-count');
    const gradeFilter = document.getElementById('gradeSelectTeacher');
    const subjectFilter = document.getElementById('subjectSelectTeacher');
    
    if (!searchInput || !searchButton || !tableBody || !gradeFilter || !subjectFilter) {
        return;
    }

    const rows = Array.from(tableBody.getElementsByTagName('tr'));

    function filterTeachers() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const gradeValue = gradeFilter.value;
        const subjectValue = subjectFilter.value;
        let visibleCount = 0;
        rows.forEach(row => {
            const fullName = row.cells[1].textContent.toLowerCase();
            const className = row.cells[5].textContent;
            const grade = className.match(/^Grade (\d+)/)?.[1] || '';
            const subject = row.cells[4].textContent;

            const matchesSearch = searchTerm === '' || fullName.includes(searchTerm);
            const matchesGrade = gradeValue === '' || grade === gradeValue;
            const matchesSubject = subjectValue === '' || subject === subjectValue;
        
            if (matchesSearch && matchesGrade && matchesSubject) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update count display
        if (teacherCount) {
            teacherCount.textContent = `Showing: ${visibleCount} Result(s) out of ${window.totalTeachers} Total`;
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

    gradeFilter.addEventListener('change', filterTeachers);
    subjectFilter.addEventListener('change', filterTeachers);

}

// Optional: Auto-run when imported
document.addEventListener('DOMContentLoaded', initTeacherSearch);