<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Area</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <div class="content">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture">
                    <div class="details">
                        <span>Coding Benayah</span>
                        <p>Active now</p>
                    </div>
                </div>
                <a href="#" class="logout">Logout</a>
            </header>
            <div class="search">
                <div class="search-wrapper">
                    <input type="text" placeholder="Search for a chat..." class="search-input">
                    <button class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            
            <div class="chat-box">
                <div class="message outgoing">
                    <p>Hello! How can I assist you today?</p>
                </div>
                <div class="message incoming">
                    <p>Hey! I need some help styling my chat area.</p>
                </div>
            </div>
            <form action="#" class="typing-area">
                <input type="text" placeholder="Type a message here...">
                <button><i class="fas fa-paper-plane"></i></button>
            </form>
        </section>
    </div>
</body>
</html>
