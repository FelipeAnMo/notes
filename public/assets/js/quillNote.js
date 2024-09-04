var quill;
var isSaved = true;

$(document).ready(function() {
    quill = new Quill('#note', {
        modules: {
            toolbar: false
        }
    });

    let text = quill.root.innerHTML;

    $("#note").attr("spellcheck", "false");

    $("#note").on('click', function() {
        quill.focus();
    });

    function updateButtonStates() {
        var selection = quill.getSelection();
        
        if (selection) {
            var formats = quill.getFormat(selection.index, selection.length);
            if(formats.bold) {
                $('.btnTextBold').addClass('filter-selected');
            } else {
                $('.btnTextBold').removeClass('filter-selected');
            }

            if(formats.italic) {
                $('.btnTextItalic').addClass('filter-selected');
            } else {
                $('.btnTextItalic').removeClass('filter-selected');
            }

            if(formats.underline) {
                $('.btnTextUnderline').addClass('filter-selected');
            } else {
                $('.btnTextUnderline').removeClass('filter-selected');
            }
        }
    }

    updateButtonStates();

    $(document).on('click', '.btnTextBold', function() {
        var format = quill.getFormat();
        var isBold = format.bold;

        $(this).toggleClass('filter-selected');

        quill.format('bold', !isBold);
    });

    $(document).on('click', '.btnTextItalic', function() {
        var format = quill.getFormat();
        var isItalic = format.italic;

        $(this).toggleClass('filter-selected');

        quill.format('italic', !isItalic);
    });

    $(document).on('click', '.btnTextUnderline', function() {
        var format = quill.getFormat();
        var isUnderline = format.underline;

        $(this).toggleClass('filter-selected');

        quill.format('underline', !isUnderline);
    });

    quill.on('selection-change', function() {
        updateButtonStates();
    });

    quill.on('text-change', function() {
        updateButtonStates();
    });

    $(document).on('keydown', function(event) {
        if(quill.root.innerHTML != text) {
            $('.btnSaveNote').css('border', '3px solid #656565');
            isSaved = false;
        }

        if (event.ctrlKey && event.key === 's') {
            event.preventDefault();
            SaveNote();
        }
    });
});

$(document).on('click', '.btnSaveNote', function() {
    SaveNote();
    alert('Saved!');
});

$(window).on('beforeunload', function (event) {
    const url = window.location.pathname;

    if(!isSaved && url.includes("note")) {
        var confirmMessage = "You have unsaved changes, are you sure you want to leave?";

        event.preventDefault();
        event.returnValue = confirmMessage;

        return confirmMessage;
    }
});

function SaveNote() {
    let noteTitle = $('#note-title').val();
    let noteText = quill.root.innerHTML
    let urlParts = window.location.pathname.split('/');
    let noteId = urlParts[urlParts.length - 1];
    let fontFamily = $('.select-selected').html();
    let tagColor = rgbToHex($('.btnTag').css('background-color'));

    $.ajax({
        url: baseURL+'home/saveNote',
        method: 'POST',
        data: {
            noteTitle: noteTitle, 
            noteText: noteText,
            noteId: noteId,
            fontFamily: fontFamily,
            tagColor: tagColor
        },
        success: function(response) {
            $('.btnSaveNote').css('border', '3px solid #b5b6a0');
            isSaved = true;
            
            if(response !== "") {
                window.history.pushState({}, '', window.location.href + "/" + response);
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr);
        }
    });
}