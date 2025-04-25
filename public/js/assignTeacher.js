export function filterByAcademicYear() {
    const academicYear = document.getElementById('academicYearAssign').value;
    window.location.href = `${window.URLROOT}/teacher/assignClassTeacher?academicYear=${encodeURIComponent(academicYear)}`;
}

export function openModal(classId, className) {
    const modal = document.getElementById('assignModal');
    document.getElementById('modalClassId').value = classId;
    document.getElementById('modalClassName').innerText = className;
    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('modal-open');
}

export function closeModal() {
    const modal = document.getElementById('assignModal');
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('modal-open');
    document.getElementById('teacherSelect').selectedIndex = 0;
}

export function initAssignClassTeacher() {
    console.log('Initializing assign class teacher functionality');
    const academicYearSelect = document.getElementById('academicYearAssign');
    const assignButtons = document.querySelectorAll('.btn-edit');
    const cancelButton = document.querySelector('.modal .cancel-btn');
    const form = document.getElementById('assign-form');
    
    if (academicYearSelect) {
        academicYearSelect.addEventListener('change', filterByAcademicYear);
    }
    
    assignButtons.forEach(button => {
        button.addEventListener('click', () => {
            const classId = button.getAttribute('data-class-id');
            const className = button.getAttribute('data-class-name');
            openModal(classId, className);
        });
    });
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const teacherId = document.getElementById('teacherSelect').value;
            if (!teacherId) {
                e.preventDefault();
                alert('Please select a teacher.');
                return false;
            }
        });
    }
    
    if (cancelButton) {
        cancelButton.addEventListener('click', closeModal);
    }
}