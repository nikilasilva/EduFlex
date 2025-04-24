export function searchAnnouncements(searchInputSelector, tableSelector) {
    const searchInput = document.querySelector(searchInputSelector);
    const table = document.querySelector(tableSelector);
    const announcementCount = document.querySelector('.announcement-count');
    
    if (!searchInput || !table) {
        console.error('Search elements not found for announcements');
        return;
    }

    console.log('Search initialized for announcements');
    
    searchInput.addEventListener('input', () => {
        const query = searchInput.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');
        let visibleCount = 0;

        rows.forEach(row => {
            const title = row.cells[0]?.textContent.toLowerCase() || '';
            const content = row.cells[1]?.textContent.toLowerCase() || '';
            const type = row.cells[2]?.textContent.toLowerCase() || '';
            const audience = row.cells[3]?.textContent.toLowerCase() || '';

            if (title.includes(query) || content.includes(query) || type.includes(query) || audience.includes(query)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update count display
        if (announcementCount) {
            announcementCount.textContent = `Showing: ${visibleCount} Result(s) out of ${window.totalAnnouncements} Total`;
        }
    });
}

export function handleDeleteConfirmation({
    deleteBtnSelector = '.btn-delete',
    modalSelector = '#delete-confirmation-modal',
    modalTitleSelector = '#delete-announcement-title',
    confirmBtnSelector = '#delete-confirm',
    cancelBtnSelector = '#delete-cancel',
    formSelector = '#delete-form',
    formInputIdSelector = '#delete-form-id',
    postActionUrl = '/Announcement/deleteAnnouncement'
} = {}) {
    const deleteButtons = document.querySelectorAll(deleteBtnSelector);
    const modal = document.querySelector(modalSelector);
    const titleSpan = document.querySelector(modalTitleSelector);
    const confirmButton = document.querySelector(confirmBtnSelector);
    const cancelButton = document.querySelector(cancelBtnSelector);
    const deleteForm = document.querySelector(formSelector);
    const deleteFormIdInput = document.querySelector(formInputIdSelector);

    if (!modal || !titleSpan || !confirmButton || !cancelButton || !deleteForm || !deleteFormIdInput) {
        console.error("One or more delete confirmation elements not found");
        return;
    }

    let currentId = null;

    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            currentId = button.dataset.id;
            const title = button.dataset.title;

            console.log('Delete button clicked for ID:', currentId, 'Title:', title);
            titleSpan.textContent = title;
            modal.classList.add('show');
            modal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('modal-open');
        });
    });

    confirmButton.addEventListener('click', (event) => {
        event.preventDefault();
        console.log('Confirm delete clicked for ID:', currentId);
        deleteFormIdInput.value = currentId;
        
        // Get the URLROOT from the global window object if available
        let actionUrl = postActionUrl;
        if (window.URLROOT) {
            actionUrl = `${window.URLROOT}/Announcement/deleteAnnouncement`;
        }
        
        console.log('Submitting form to:', actionUrl);
        deleteForm.setAttribute('action', actionUrl);
        deleteForm.method = 'POST';
        deleteForm.submit();
    });

    cancelButton.addEventListener('click', () => {
        console.log('Delete canceled');
        closeModal();
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('show')) {
            closeModal();
        }
    });

    function closeModal() {
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
    }
}

export function restrictPastDateTime() {
    const dateInput = document.getElementById('announcement-date');
    const timeInput = document.getElementById('announcement-time');

    if (!dateInput || !timeInput) {
        console.warn('Date or time input not found');
        return;
    }

    const now = new Date();
    const today = now.toISOString().split('T')[0]; // Format: YYYY-MM-DD
    const currentTime = now.toTimeString().slice(0, 5); // Format: HH:MM

    // Set min date to today
    dateInput.min = today;

    // Check time on date change
    dateInput.addEventListener('change', function () {
        if (dateInput.value === today) {
            timeInput.min = currentTime;
        } else {
            timeInput.removeAttribute('min');
        }
    });

    // Apply initial logic in case today is already selected
    if (dateInput.value === today) {
        timeInput.min = currentTime;
    }
}


export function initAnnouncements() {
    console.log('Initializing announcements functionality');
    const cancelBtn = document.querySelector(".cancel-ann-btn");

    // Try to get URLROOT from window if it exists
    const urlRoot = window.URLROOT || '';
    console.log('Using URLROOT:', urlRoot);
    
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function () {
        window.location.href = `${window.URLROOT}/announcement/viewAnnouncement`;
    });
    }
    
    restrictPastDateTime();
    // Use the correct selector for the table
    searchAnnouncements('#announcement-search', '.announcement-table');
    
    handleDeleteConfirmation({
        postActionUrl: `${urlRoot}/Announcement/deleteAnnouncement`,
        deleteBtnSelector: '.btn-delete',
        modalSelector: '#delete-confirmation-modal',
        formSelector: '#delete-form'
    });
}

// For debugging, ensure we can call this from the console
// window.initAnnouncementsDebug = initAnnouncements;