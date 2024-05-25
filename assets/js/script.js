
document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('toggleTheme');
    const currentTheme = localStorage.getItem('theme') || 'light';

    document.body.classList.add(currentTheme + '-theme');

    toggleButton.addEventListener('click', () => {
        let theme = document.body.classList.contains('light-theme') ? 'dark' : 'light';
        document.body.classList.toggle('light-theme');
        document.body.classList.toggle('dark-theme');
        localStorage.setItem('theme', theme);
    });

    const registerLink = document.getElementById('register-link');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');

    registerLink.addEventListener('click', (e) => {
        e.preventDefault();
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    });

    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Ajoutez ici la logique pour le formulaire de connexion
        alert('Connexion réussie');
    });

    registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Ajoutez ici la logique pour le formulaire d'inscription
        alert('Inscription réussie');
    });
});
document.getElementById('back-button').addEventListener('click', function() {
    window.history.back();
});
