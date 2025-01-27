// Function to handle password toggle
function setupPasswordToggle() {
    // Select all password wrappers with a toggle icon
    const passwordWrappers = document.querySelectorAll(".password-wrapper");

    passwordWrappers.forEach(wrapper => {
        const passwordField = wrapper.querySelector("input[type='password']");
        const toggleIcon = wrapper.querySelector(".toggle-password");

        if (passwordField && toggleIcon) {
            toggleIcon.addEventListener("click", () => {
                // Toggle the password field's type
                const isPassword = passwordField.type === "password";
                passwordField.type = isPassword ? "text" : "password";

                // Update the eye icon class
                toggleIcon.classList.toggle("fa-eye-slash", isPassword);
                toggleIcon.classList.toggle("fa-eye", !isPassword);
            });
        }
    });
}

// Initialize the script
document.addEventListener("DOMContentLoaded", setupPasswordToggle);
