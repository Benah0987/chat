<?php
include_once 'config.php'; // Ensure this file connects to your database

// Fetch the input data from the HTML form
$fname = mysqli_real_escape_string($conn, $_POST['first_name']);
$lname = mysqli_real_escape_string($conn, $_POST['last_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$image = $_FILES['image']; // Handle the file upload

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if the email already exists in the database
$sql_check_email = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql_check_email);

if (mysqli_num_rows($result) > 0) {
    // Email already exists
    echo "This email is already taken. Please choose another one.";
    exit(); // Stop further execution
}

// Handle file upload (ensure the image is valid)
if ($image['error'] !== UPLOAD_ERR_OK) {
    echo "Error uploading the file. Please try again.";
    exit();
}

$imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
$allowedTypes = ['jpg', 'jpeg', 'png', 'gif']; // Allowed image file types

if (!in_array($imageFileType, $allowedTypes)) {
    echo "Only image files (JPG, JPEG, PNG, GIF) are allowed.";
    exit();
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
    exit();
}

// Store the form data and image path in the database
$imagePath = mysqli_real_escape_string($conn, $uploadPath); // Escape the image path for SQL
$sql = "INSERT INTO users (first_name, last_name, email, password, image) 
        VALUES ('$fname', '$lname', '$email', '$hashed_password', '$imagePath')";

if (mysqli_query($conn, $sql)) {
    // Redirect to users.php after successful signup
    header("Location: ../users.php");
    exit(); // Make sure to call exit() to stop further execution
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
