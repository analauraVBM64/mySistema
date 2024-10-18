document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.getElementById('signupForm');
    const loginForm = document.getElementById('loginForm');

    // Validação do formulário de cadastro
    if (signupForm) {
        signupForm.addEventListener('submit', function(event) {
            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (!username || !email || !password || !confirmPassword) {
                alert('Todos os campos são obrigatórios.');
                event.preventDefault(); // Impede o envio do formulário
                return;
            }

            if (password !== confirmPassword) {
                alert('As senhas não coincidem.');
                event.preventDefault(); // Impede o envio do formulário
                return;
            }
        });
    }

    // Validação do formulário de login
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            const email = document.getElementById('loginEmail').value.trim();
            const password = document.getElementById('loginPassword').value;

            if (!email || !password) {
                alert('Todos os campos são obrigatórios.');
                event.preventDefault(); // Impede o envio do formulário
                return;
            }
        });
    }
});
