const form = document.querySelector(".signup form");

form.onsubmit = (e) => {
  e.preventDefault(); // Prevent form submission to reload the page

  // Create an XMLHttpRequest
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/signup.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response; // Response from the server
        console.log(data); // Display response in console
      }
    }
  };

  let formData = new FormData(form); // Get form data
  xhr.send(formData); // Send form data to the server
};
