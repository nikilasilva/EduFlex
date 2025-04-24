export function initFlashMessage() {
    const flashMessage = document.getElementById("flash-message");
    if (flashMessage) {
        setTimeout(() => {
            flashMessage.style.transition = "opacity 0.5s ease";
            flashMessage.style.opacity = "0";

            setTimeout(() => {
                flashMessage.remove();
            }, 500); // remove after fade-out
        }, 3000); // show message for 3 seconds
    }
}