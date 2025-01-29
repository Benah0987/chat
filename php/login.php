<?php
// Start the session
session_start();

// Include the database connection file
include_once 'config.php'; 

// Check if the signup was successful and show a message
if (isset($_SESSION['signup_success']) && $_SESSION['signup_success'] == true) {
    echo "<p class='success-message'>Signup successful! You can now log in.</p>";
    unset($_SESSION['signup_success']);  // Clear the success message after it's displayed
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the database for user credentials
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Login successful, set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
            header("Location: chat.php"); // Redirect to chat page
            exit();
        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "No user found with this email.";
    }

    // If there's an error, show the message
    if (isset($error_message)) {
        echo "<p class='error-message'>$error_message</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login - Chat App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
  <div class="wrapper">
    <section class="form signup">
        <header>Realtime Chat App</header>
        <form method="POST">
            <div class="error-txt">This is an error message</div>
            <div class="name-details">
                <div class="field">
                    <label for="email">Email Address</label>
                    <input type="text" id="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" placeholder="Enter Password" required>
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                </div>
                <div class="field">
                    <input type="submit" value="Continue to Chat">
                </div>
                <div class="link">Don't have an Account? <a href="signup.php">Sign Up</a></div>
            </div>
        </form>
    </section>
  </div>
  <script src="javascript/pass-show-hide.js"></script>
</body>
</html>
