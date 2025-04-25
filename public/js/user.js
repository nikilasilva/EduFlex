export function handleDeletePictureConfirmation() {
       // Delete picture confirmation functionality
       console.log("hello");
       const deleteButton = document.querySelector('.picture-delete-btn');
       const modal = document.querySelector('#delete-picture-modal');
       const confirmButton = document.querySelector('#picture-delete-confirm');
       const cancelButton = document.querySelector('#picture-delete-cancel');
       const deleteForm = document.querySelector('#delete-picture-form');
   
       if (deleteButton && modal && confirmButton && cancelButton && deleteForm) {
           deleteButton.addEventListener('click', function(event) {
               event.preventDefault();
               modal.classList.add('show');
               modal.setAttribute('aria-hidden', 'false');
               document.body.classList.add('modal-open');
           });
   
           confirmButton.addEventListener('click', function(event) {
               event.preventDefault();
               deleteForm.submit();
           });
   
           cancelButton.addEventListener('click', function() {
               closeModal();
           });
   
           modal.addEventListener('click', function(e) {
               if (e.target === modal) {
                   closeModal();
               }
           });
   
           document.addEventListener('keydown', function(e) {
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
}