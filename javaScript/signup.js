document.querySelector("#signupForm").addEventListener("submit", function (event) {
  event.preventDefault(); // Prevent default form submission

  let formData = new FormData(this); // Get form data

  fetch("php/signup.php", {
      method: "POST",
      body: formData
  })
  .then(response => response.text()) // Read response
  .then(data => {
      console.log("🚀 Server Response:", data.trim()); // Debugging

      if (data.trim() === "success") { // Ensure exact match
          console.log("✅ Redirecting to login.php...");
          setTimeout(() => {
              window.location.href = "login.php"; // Redirect to login page
          }, 500); // Short delay for smoother transition
      } else {
          console.error("❌ Error:", data);
          alert("Error: " + data); // Show error message
      }
  })
  .catch(error => console.error("⚠️ Fetch Error:", error));
});
