function autoResize() {
    const textarea = document.getElementById('editable-textarea');
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
}
document.addEventListener('DOMContentLoaded', autoResize);
document.getElementById('editable-textarea').addEventListener('input', autoResize);
