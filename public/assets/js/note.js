$(document).ready(function() {
    let noteHeight = parseFloat($('#note').css('height'));
    let noteWidth = (noteHeight / 3) + 28;

    $('header').css('display', 'inline');

    toggleFont();

    $(document).on('click', '#btnApplyTagColor', function() {
        let inputHexColor = $('#input-tag-color').val();

        if(inputHexColor.charAt(0) === '#') {
            $('.btnTag').css('background-color', inputHexColor);
        }
    });

    $('#preset-color-1, #preset-color-2, #preset-color-3, #preset-color-4').on('click', function() {
        $('.btnTag').css('background-color', rgbToHex($(this).css('background-color')));
    });

    $(document).on('click', '.btnTag', function() {
        let modal = $('.modal-tag-color');
        let isModalVisible = modal.hasClass('show');

        if (isModalVisible) {
            modal.removeClass('show');
            $(this).removeClass('filter-selected-tag-color');
        } else {
            let buttonOffset = $(this).offset();
            modal.css({
                top: buttonOffset.top - 7 + 'px',
                left: buttonOffset.left + $(this).outerWidth() + 12 + 'px'
            }).addClass('show');
            $(this).addClass('filter-selected-tag-color');
        }
    });

    $(document).on('click', function(event) {
        if (!$(event.target).closest('.modal-tag-color, .btnTag').length) {
            $('.modal-tag-color').removeClass('show');
            $('.btnTag').removeClass('filter-selected-tag-color');
        }
    });

    $('footer').css({
        'position': 'fixed',
        'bottom': '0'
    });

    function resizeInput() {
        $('#input-sizer').text($('#note-title').val() || $('#note-title').attr('placeholder'));
        $('#note-title').width($('#input-sizer').width() + 2);
    }

    function resizeNote() {
        $('#note').css('width', noteHeight - noteWidth + 'px');
    }

    $(window).on('resize', function() {
        noteHeight = parseFloat($('#note').css('height'));
        noteWidth = noteHeight / 3;

        resizeNote();
    });

    $('#note-title').on('input', resizeInput);

    resizeNote();
    resizeInput();

    $(document).on('click', '.btnFontSelector', function() {
        let modal = $('.modal-text-config');
        let isModalVisible = modal.hasClass('show');

        if (isModalVisible) {
            modal.removeClass('show');
            $(this).removeClass('filter-selected');
        } else {
            let buttonOffset = $(this).offset();
            modal.css({
                top: buttonOffset.top - 7 + 'px',
                left: buttonOffset.left + $(this).outerWidth() + 12 + 'px'
            }).addClass('show');
            $(this).addClass('filter-selected');
        }
    });

    $(document).on('click', function(event) {
        if (!$(event.target).closest('.modal-text-config, .btnFontSelector').length) {
            $('.modal-text-config').removeClass('show');
            $('.btnFontSelector').removeClass('filter-selected');
        }
    });

    var $selected = $('.select-selected');
    var $items = $('.select-items');
    var $selectItems = $items.find('.select-item');

    $selected.on('click', function() {
        $items.toggleClass('select-hide');
    });

    $selectItems.on('click', function() {
        var selectedText = $(this).text();
        $selected.text(selectedText);
        $items.addClass('select-hide');
        toggleFont();
    });

    $(document).on('click', function(event) {
        if (!$(event.target).closest('.custom-select').length) {
            $items.addClass('select-hide');
        }
    });
});

function toggleFont() {
    switch($('.select-selected').text()) {
        case 'Playwrite D. G.':
            $('#note').css('font-family', '"Playwrite DE Grund", cursive');
            break;

        case 'Roboto':
            $('#note').css('font-family', '"Roboto", sans-serif');
            break;

        case 'Open Sans':
            $('#note').css('font-family', '"Open Sans", sans-serif');
            break;

        case 'Playwrite A.':
            $('#note').css('font-family', '"Playwrite AR", cursive');
            break;

        case 'Arial':
            $('#note').css('font-family', 'Arial, Helvetica, sans-serif');
            break;

        case 'Times New Roman':
            $('#note').css('font-family', '"Times New Roman", Times, serif');
            break;
    }
}
