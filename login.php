<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Chat App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
  <div class="wrapper">
    <section class="form signup">
        <header> Realtime Chat App</header>
        <form action="#">
            <div class="error-txt">This is an error message</div>
            <div class="name-details">
                <div class="field">
                    <label for="email">Email Address</label>
                    <input type="text" id="email" placeholder="Enter email">
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" placeholder="Enter Password">
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                </div>
                <div class="field">
                    <input type="submit" value="Continue to Chat">
                </div>
                <div class="link"> Don't have an Account? <a href="#">Sign Up</a></div>
            </div>
        </form>
    </section>
  </div>
  <script src="javascript/pass-show-hide.js"></script>
</body>
</html>
