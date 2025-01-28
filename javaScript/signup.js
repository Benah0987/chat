const form = document.querySelector(".signup form");

form.onsubmit = (e) => {
  e.preventDefault(); // Prevent form submission to avoid page reload

  console.log("Form submitted!");

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/signup.php", true); // Matches your form action
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        console.log("Response from server:", xhr.response);
      } else {
        console.error("Request failed with status:", xhr.status);
      }
    }
  };

  xhr.onerror = () => {
    console.error("There was an error with the request");
  };

  let formData = new FormData(form);
  console.log("Form data being sent:", formData);

  xhr.send(formData);
};
