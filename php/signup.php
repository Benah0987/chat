<?php
include_once 'config.php';

// Check if the form is empty or if a file has not been uploaded
if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_FILES['image']['name'])) {
    echo "Please fill all the fields, including uploading an image.";
    exit(); // Stop further execution
}

// Fetch the input data from the HTML form
$fname = mysqli_real_escape_string($conn, $_POST['first_name']);
$lname = mysqli_real_escape_string($conn, $_POST['last_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$image = $_FILES['image']; // Handle the file upload

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
    exit(); // Stop further execution
}

// Check if the uploaded file is an image and if the upload was successful
if ($image['error'] !== UPLOAD_ERR_OK) {
    echo "Error uploading the file. Please try again.";
    exit(); // Stop further execution
}

// Check if the uploaded file is an image (you can add more conditions such as size/type)
$imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
$allowedTypes = ['jpg', 'jpeg', 'png', 'gif']; // Allowed image file types
if (!in_array($imageFileType, $allowedTypes)) {
    echo "Only image files (JPG, JPEG, PNG, GIF) are allowed.";
    exit(); // Stop further execution
}

// Save the uploaded file to the server
$uploadDir = 'uploads/'; // Specify the directory for storing images
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
}
$imageName = time() . "_" . basename($image['name']); // Generate a unique filename
$uploadPath = $uploadDir . $imageName;

if (!move_uploaded_file($image['tmp_name'], $uploadPath)) {
    echo "Failed to upload the image.";
    exit(); // Stop further execution
}

// Store the form data and image path in the database
$imagePath = mysqli_real_escape_string($conn, $uploadPath); // Escape the image path for SQL
$sql = "INSERT INTO users (first_name, last_name, email, password, image) VALUES ('$fname', '$lname', '$email', '$password', '$imagePath')";

if (mysqli_query($conn, $sql)) {
    echo "Registration successful!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
