export function initUploadUsers() {
    const form = document.getElementById('upload-csv-form');
    const fileInput = document.getElementById('csv-file');
    const message = document.getElementById('upload-message');

    if (!form || !fileInput || !message) {
        return;
    }

    form.addEventListener('submit', function (e) {
        message.textContent = '';
        message.classList.remove('error', 'success');

        if (!fileInput.files || fileInput.files.length === 0) {
            e.preventDefault();
            message.textContent = 'Please select a CSV file.';
            message.classList.add('error');
            return;
        }

        const file = fileInput.files[0];
        const extension = file.name.split('.').pop().toLowerCase();
        if (extension !== 'csv') {
            e.preventDefault();
            message.textContent = 'Only CSV files are allowed.';
            message.classList.add('error');
            return;
        }

        const maxSize = 5 * 1024 * 1024; // 5MB
        if (file.size > maxSize) {
            e.preventDefault();
            message.textContent = 'File size exceeds 5MB limit.';
            message.classList.add('error');
            return;
        }

        message.textContent = 'Uploading...';
        message.classList.add('success');
    });
}