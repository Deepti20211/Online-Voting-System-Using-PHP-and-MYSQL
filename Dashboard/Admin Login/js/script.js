document.addEventListener('DOMContentLoaded', (event) => {
    const eyeIcon = document.querySelector('.eye-icon');
    const passwordInput = document.querySelector('input[name="password"]');

    // Toggle password visibility
    eyeIcon.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.replace('bx-hide', 'bx-show');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.replace('bx-show', 'bx-hide');
        }
    });

    // Basic form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', (event) => {
        const username = form.querySelector('input[name="username"]').value.trim();
        const password = passwordInput.value.trim();
u
        if (username === '' || password === '') {
            alert('Please fill in both fields.');
            event.preventDefault(); // Prevent form submission
        }
    });
});
