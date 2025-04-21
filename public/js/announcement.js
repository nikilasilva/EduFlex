export function searchAnnouncements(searchInputSelector, tableSelector) {
    const searchInput = document.querySelector(searchInputSelector);
    const table = document.querySelector(tableSelector);
    
    if (!searchInput || !table) {
        console.error('Search elements not found for announcements');
        return;
    }

    console.log('Search initialized for announcements');
    
    searchInput.addEventListener('input', () => {
        const query = searchInput.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const title = row.cells[0]?.textContent.toLowerCase() || '';
            const content = row.cells[1]?.textContent.toLowerCase() || '';
            const type = row.cells[2]?.textContent.toLowerCase() || '';
            const audience = row.cells[3]?.textContent.toLowerCase() || '';

            row.style.display = (title.includes(query) || content.includes(query) || 
                                type.includes(query) || audience.includes(query)) 
                                ? '' : 'none';
        });
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

    // Add debugging
    console.log('Delete buttons found:', deleteButtons.length);
    console.log('Modal found:', !!modal);
    console.log('Title span found:', !!titleSpan);
    console.log('Confirm button found:', !!confirmButton);
    console.log('Cancel button found:', !!cancelButton);
    console.log('Delete form found:', !!deleteForm);
    console.log('Delete form ID input found:', !!deleteFormIdInput);

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

export function initAnnouncements() {
    console.log('Initializing announcements functionality');
    
    // Try to get URLROOT from window if it exists
    const urlRoot = window.URLROOT || '';
    console.log('Using URLROOT:', urlRoot);
    
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
window.initAnnouncementsDebug = initAnnouncements;