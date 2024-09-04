<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>

    <!-- JQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Quill -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/2.0.2/quill.min.js" integrity="sha512-1nmY9t9/Iq3JU1fGf0OpNCn6uXMmwC1XYX9a6547vnfcjCY1KvU9TE5e8jHQvXBoEH7hcKLIbbOjneZ8HCeNLA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="http://your-notes.rf.gd/assets/css/style.css">
    <!-- Script JS -->
    <script src="http://your-notes.rf.gd/assets/js/script.js"></script>
</head>
<body>
    <?php if(isset($id)): ?>
        <header>
            <div id="account-area">
                <button type="button" id="user-account">
                    <i class="fa-solid fa-user"></i>
                </button>
                <button type="button" id="user-config">
                    <i class="fa-solid fa-gear"></i>
                </button>
                <button id="btnHiddenHeader">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <ul id="nav-list">
                <li>
                    <button type="button" class="nav-notes">
                        <div id="home-button" class="nav-item-background">
                            <a>Notes</a>
                        </div>
                    </button>
                </li>

                <li>
                    <button type="button" class="nav-notes">
                        <div id="new-note" class="nav-item-background">
                            <a>New note</a>
                        </div>
                    </button>
                </li>
            </ul>
            <div id="links-box">
                <a href="https://github.com/FelipeAnMo" target="blank">
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="https://www.linkedin.com/in/felipe-andrade-moretzsohn-aa6129251/" target="blank">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
            </div>
        </header>
    <?php else: ?>
        <header style="width: 20%; left: -500px;">
            <div id="title-notes">
                <h1>Notes</h1>
            </div>
            <div id="signUp-box">
                <button id="signUp" type="button">Sign Up</button>
            </div>
            <div id="logIn-box">
                <button id="logIn" type="button">Log In</button>
            </div>
            <div id="links-box">
                <a href="https://github.com/FelipeAnMo" target="blank">
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="https://www.linkedin.com/in/felipe-andrade-moretzsohn-aa6129251/" target="blank">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
            </div>
        </header>
    <?php endif; ?>
    <div id="header-spacing"></div>
    <section id="content">

