function togglePasswordVisibility() {
    let passwordInput = document.getElementById("password");
    let passwordToggle = document.querySelector(".password-toggle");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordToggle.classList.add("show-password");
    } else {
        passwordInput.type = "password";
        passwordToggle.classList.remove("show-password");
    }
}