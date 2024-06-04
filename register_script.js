function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var passwordToggle = document.getElementById("passwordToggle");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordToggle.classList.remove("fa-eye-slash");
        passwordToggle.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        passwordToggle.classList.remove("fa-eye");
        passwordToggle.classList.add("fa-eye-slash");
    }
}

function validatePasswordMatch() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
        return "Passwords do not match.";
    } else {
        return "";
    }
}

document.getElementById("registrationForm").addEventListener("submit", function(event) {
    var errorMessage = validatePasswordMatch();
    var passwordMatchMessage = document.getElementById("passwordMatchMessage");
    passwordMatchMessage.textContent = errorMessage;
    if (errorMessage) {
        event.preventDefault();
    }
});
