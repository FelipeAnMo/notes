$(document).ready(function() {
    let headerIndex = $('header').html();
    let headerSign = `
        <div id="title-notes">
            <h1>Notes</h1>
        </div>
        <div id="input-box">
            <div id="return-box">
                <button type="button" id="btnReturnIndex">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </div>
            <input type="text" id="nameInput" placeholder="Name">
            <input type="email" id="emailInput" placeholder="E-mail">
            <input type="password" id="passInput" placeholder="Password">
            <button id="signUp-send" type="button">Continue</button>
        </div>`;
    let headerLogIn = `
        <div id="title-notes">
            <h1>Notes</h1>
        </div>
        <div id="input-box">
            <div id="return-box">
                <button type="button" id="btnReturnIndex">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </div>
            <input type="email" id="emailInput" placeholder="E-mail">
            <input type="password" id="passInput" placeholder="Password">
            <button id="logIn-send" type="button">Continue</button>
        </div>`;

    setTimeout(function() {
        $('header').css('left', '0px');
    }, 500);

    $(document).on('click', '#signUp', function() {
        $('header').css('left', '-500px');
        waitForLeftChange('signUp');
    });

    $(document).on('click', '#logIn', function() {
        $('header').css('left', '-500px');
        waitForLeftChange('logIn');
    });

    $(document).on('click', '#btnReturnIndex', function() {
        $('header').css('left', '-500px');
        waitForLeftChange('index');
    });

    $(document).on('focus', '#emailInput', function() {
        $('#emailInput').attr('placeholder', 'E-mail');
        $('#emailInput').css('border', '3px solid #b5b6a0');
    });

    $(document).on('click', '#signUp-send', function() {
        let formData = {
            name: $('#nameInput').val(),
            email: $('#emailInput').val(),
            password: $('#passInput').val()
        }
        UserAJAXRequisition('home/signUp', formData);
    });

    $(document).on('click', '#logIn-send', function() {
        let formData = {
            email: $('#emailInput').val(),
            password: $('#passInput').val()
        }
        UserAJAXRequisition('home/logIn', formData);
    });

    function waitForLeftChange(page) {
        var interval = setInterval(function() {
            var currentLeft = parseInt($('header').css('left'), 10);
            if (currentLeft === -500) {
                if(page === 'signUp') {
                    $('header').html(headerSign);
    
                } else if(page === 'logIn') {
                    $('header').html(headerLogIn);

                } else if(page === 'index') {
                    $('header').html(headerIndex);

                }
    
                $('header').css('left', '0px');
                clearInterval(interval);
            }
        }, 100); 
    }

    if(window.innerWidth > 992) {
        $('#note-space').css('opacity', '1');
        $('#content').css('overflow', 'hidden');
    }
});