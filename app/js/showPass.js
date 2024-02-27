const showPassword = document.querySelector('#showPassword');
const passwordField = document.querySelector('#clientPassword');

showPassword.addEventListener('click', () => {
    const type = passwordField.getAttribute('type') === "password" ? "text" : "password";
    passwordField.setAttribute('type', type);
});