let baseURL = 'http://your-notes.rf.gd/';
let angle = 0;

$(document).ready(function() {
    let element = $('.fa-gear');
    
    $('#home-button').on('click', function() {
        window.location.replace(baseURL);
    });

    $('#new-note').on('click', function() {
        window.location.replace(baseURL+'home/note');
    });

    $('.nav-notes').on('mouseenter', function() {
        $(this).children().css('width', '86%');
    });

    $('.nav-notes').on('mouseleave', function() {
        $(this).children().css('width', '100%');
    });

    $('#user-config').on('mouseenter', function() {
        rotating = true;
        rotate();
    });

    $('#user-config').on('mouseleave', function() {
        rotating = false;
    });

    $('#user-config').on('click', function() {
        var buttonPosition = $(this).position();
        let elementModal = $('#delete-account-modal');

        $('#delete-account-modal').css({
            top: buttonPosition.top + 50,
            left: buttonPosition.left + 110
        });
    
        if (elementModal.hasClass('show')) {
            elementModal.removeClass('show');
            setTimeout(function() {
                elementModal.css('display', 'none');
            }, 500);
        } else {
            elementModal.css('display', 'flex');
            setTimeout(function() {
                elementModal.addClass('show');
            }, 10);
        }
    });

    $('#user-account').on('click', function() {
        var buttonPosition = $(this).position();
        let elementModal = $('#logout-modal');

        $('#logout-modal').css({
            top: buttonPosition.top + 55,
            left: buttonPosition.left
        });
    
        if (elementModal.hasClass('show')) {
            elementModal.removeClass('show');
            setTimeout(function() {
                elementModal.css('display', 'none');
            }, 500);
        } else {
            elementModal.css('display', 'flex');
            setTimeout(function() {
                elementModal.addClass('show');
            }, 10);
        }
    });

    $(document).mouseup(function(e) {
        if (!$('#logout-modal').is(e.target) && (!$('#user-account').is(e.target) && !$('.fa-user').is(e.target)) && $('#logout-modal').css('display') == 'flex') {
            $('#logout-modal').removeClass('show');
            setTimeout(function() {
                $('#logout-modal').css('display', 'none');
            }, 500);
        }

        if (!$('#delete-account-modal').is(e.target) && (!$('#user-config').is(e.target) && !$('.fa-user').is(e.target)) && $('#delete-account-modal').css('display') == 'flex') {
            $('#delete-account-modal').removeClass('show');
            setTimeout(function() {
                $('#delete-account-modal').css('display', 'none');
            }, 500);
        }
    });

    $('#btnLogout').on('click', function() {
        UserAJAXRequisition('home/logout');
    });

    $('#btnDeleteAccount').on('click', function() {
        UserAJAXRequisition('home/deleteAccount');

    });

    function rotate() {
        if (rotating) {
            angle = (angle + 1) % 360;
            element.css('transform', `rotate(${angle}deg)`);
            requestAnimationFrame(rotate);
        }
    }
});

function UserAJAXRequisition(URLreq, dataData='', methodType='POST') {
    $.ajax({
        url: baseURL+URLreq,
        method: methodType,
        data: dataData,
        success: function(response) {
            console.log(response);
            location.reload();
        },
        error: function(xhr, status, error) {
            if(xhr['responseJSON']['status'] === 'email error') {
                $('#emailInput').val('');
                $('#emailInput').attr('placeholder', xhr['responseJSON']['message'])
                $('#emailInput').css('border', '3px solid #cd2727');
            }

            if(xhr['responseJSON']['status'] === 'user error') {
                $('#input-box').html(`
                    <div id="return-box">
                        <button type="button" id="btnReturnIndex">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                    </div>
                    <input type="email" id="emailInput" placeholder="E-mail">
                    <input type="password" id="passInput" placeholder="Password">
                    <button id="logIn-send" type="button">Continue</button>
                    <p style="margin-top: 20px; color: #fd2828;">E-mail or password invalid</p>
                `);
            }

            console.log(xhr['responseJSON']);
        }
    });
}

function rgbToHex(rgb) {
    var rgbArray = rgb.replace(/rgba?\(|\s+|\)/g, '').split(',');
    var hex = rgbArray.map(function(x) {
        x = parseInt(x).toString(16);
        return (x.length === 1) ? '0' + x : x;
    });
    return '#' + hex.join('');
}
