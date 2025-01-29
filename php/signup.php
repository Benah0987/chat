<?php
include_once 'config.php'; // Ensure this file connects to your database

// Fetch input data from the form
$fname = mysqli_real_escape_string($conn, $_POST['first_name']);
$lname = mysqli_real_escape_string($conn, $_POST['last_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$image = $_FILES['image'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if email exists
$sql_check_email = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql_check_email);

if (mysqli_num_rows($result) > 0) {
    echo "Email already taken";
    exit();
}

// Handle file upload
if ($image['error'] !== UPLOAD_ERR_OK) {
    echo "File upload error";
    exit();
}

$imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
$allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

if (!in_array($imageFileType, $allowedTypes)) {
    echo "Invalid file type";
    exit();
}

// Save uploaded file
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}
$imageName = time() . "_" . basename($image['name']);
$uploadPath = $uploadDir . $imageName;

if (!move_uploaded_file($image['tmp_name'], $uploadPath)) {
    echo "File upload failed";
    exit();
}

// Insert into database
$imagePath = mysqli_real_escape_string($conn, $uploadPath);
$sql = "INSERT INTO users (first_name, last_name, email, password, image) 
        VALUES ('$fname', '$lname', '$email', '$hashed_password', '$imagePath')";

if (mysqli_query($conn, $sql)) {
    echo "success"; // Only return "success" (NO redirect in PHP)
} else {
    echo "Database error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
