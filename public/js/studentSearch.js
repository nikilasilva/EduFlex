export function initStudentSearch() {
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    const classFilter = document.getElementById('classSelectStudents');
    const gradeFilter = document.getElementById('gradeSelectStudents');
    const religionFilter = document.getElementById('religionSelectStudents');
    const tableBody = document.getElementById('students-table-body');
    const studentCount = document.querySelector('.student-count');

    if (!searchInput || !searchButton || !classFilter || !gradeFilter || !religionFilter || !tableBody) {
        return;
    }

    const rows = Array.from(tableBody.getElementsByTagName('tr'));

    function filterStudents() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const classValue = classFilter.value;
        const gradeValue = gradeFilter.value;
        const religionValue = religionFilter.value;
        let visibleCount = 0;

        rows.forEach(row => {
            const fullName = row.cells[1].textContent.toLowerCase();
            const className = row.cells[2].textContent;
            // Extract grade (e.g., "6" from "Grade 6-A")
            const grade = className.match(/^Grade (\d+)/)?.[1] || '';
            const religion = row.cells[5].textContent;

            const matchesSearch = searchTerm === '' || fullName.includes(searchTerm);
            const matchesClass = classValue === '' || className === classValue;
            const matchesGrade = gradeValue === '' || grade === gradeValue;
            const matchesReligion = religionValue === '' || religion === religionValue;

            if (matchesSearch && matchesClass && matchesGrade && matchesReligion) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update count display
        if (studentCount) {
            studentCount.textContent = `Showing: ${visibleCount} Result(s) out of ${window.totalStudents} Total`;
        }
    }

    // Event listeners
    searchButton.addEventListener('click', function(e) {
        e.preventDefault();
        filterStudents();
    });

    searchInput.addEventListener('input', filterStudents);

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            filterStudents();
        }
    });

    classFilter.addEventListener('change', filterStudents);
    gradeFilter.addEventListener('change', filterStudents);
    religionFilter.addEventListener('change', filterStudents);
}

// Auto-run when imported
document.addEventListener('DOMContentLoaded', initStudentSearch);