$(document).ready(function() {
    $('#btnShowHeader').on('click', function() {
        $('#content').css('left', '400px');
        $('header').css('left', '0px');
        $('header').css('width', '100vw');
    })

    $('#btnHiddenHeader').on('click', function() {
        $('#content').css('left', '0px');
        $('header').css('left', '-400px');
        $('header').css('width', '0vw');
    });
});