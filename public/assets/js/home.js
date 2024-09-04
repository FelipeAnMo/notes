$(document).ready(function() {
    $('header').css('display', 'inline');

    $(document).on('click', '.star-button', function() {
        let button = $(this);
        let noteId = button.data('id');
        let isFavorite = button.find('.fa-regular').length > 0;
    
        if (isFavorite) {
            toggleFavorite(noteId, 1, function(response) {
                $('#favorites').append(button.parent().parent().clone());
            });
        } else {
            toggleFavorite(noteId, 0, function(response) {
                let noteBox = button.closest('.note-box');
                if (noteBox.hasClass('favorite-note')) {
                    removeFavorite(noteBox);
                } else {
                    removeNoteBox(button, noteBox);
                }
            });
        }
    
        button.find('.fa-star').toggleClass('fa-regular fa-solid');
    });
    
    function toggleFavorite(noteId, favorite, successCallback) {
        $.ajax({
            url: baseURL + 'home/toggleFavorite',
            method: 'POST',
            data: {
                noteId: noteId,
                favorite: favorite
            },
            success: successCallback,
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        });
    }
    
    function removeFavorite(noteBox) {
        noteBox.remove();
        let dataId = noteBox.children().eq(1).data('id');
        console.log($('[data-id="' + dataId + '"]'));
        let buttonStar = $('[data-id="' + dataId + '"].star-button');
        buttonStar.children().removeClass('fa-solid').addClass('fa-regular');
    }
    
    function removeNoteBox(button, noteBox) {
        let dataId = noteBox.children().eq(1).data('id');
        let anotherDataId = $('[data-id="' + dataId + '"]').eq(2).find('.fa-star');
        anotherDataId.removeClass('fa-solid').addClass('fa-regular');
        let buttonStar = $('[data-id="' + dataId + '"].star-button')[0];
        $(buttonStar).parent().parent().remove();
    }

    $(document).on('click', '#note-add', function() {
        window.location.href = baseURL + 'home/note';
    });

    $(document).on('click', '.note', function() {
        window.location.href = baseURL + 'home/note/' + $(this).data('id');
    });

    $(document).on('mouseenter', '.note', function() {
        $(this).children(':first').css('top', '-109px');
    });

    $(document).on('mouseleave', '.note', function() {
        $(this).children(':first').css('top', '-116px');
    });

    $(document).on('click', '.btnMoreNoteOptions', function(event) {
        event.stopPropagation(); 
            let modal = $('.modal-delete-note');
            let isModalVisible = modal.hasClass('show');
            $('.modal-delete-note').data('id', $(this).parent().data('id'));

            if (isModalVisible) {
                modal.removeClass('show');
                $(this).removeClass('filter-selected');
            } else {
                let buttonOffset = $(this).offset();
                modal.css({
                    top: buttonOffset.top - 44 + 'px',
                    left: buttonOffset.left - 5 + 'px'
                }).addClass('show');
            $(this).addClass('filter-selected');
         }
     })
    

    $(document).on('click', function(event) {
        if (!$(event.target).closest('.modal-delete-note, .btnMoreNoteOptions').length) {
            $('.modal-delete-note').removeClass('show');
            $('.btnMoreNoteOptions').removeClass('filter-selected');
        }
    });

    $('.btnDeleteNote').on('click', function() {
        let noteId = $('.modal-delete-note').data('id');
        $.ajax({
            url: baseURL+'home/deleteNote',
            method: 'POST',
            data: {
                noteId: noteId
            },
            success: function(response) {
                $('.note[data-id="' + noteId + '"]').parent().remove();
                $('.modal-delete-note').removeClass('show');
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        });
    })

    $('.note-title').each(function() {
        var text = $(this).text();
        if (text.length > 13) {
            var truncatedText = text.substring(0, 13) + '...';
            $(this).text(truncatedText);
        }
    });

    $('#btnSearchNotes').on('click', function() {
        let searchNote = $('#search-notes-input').val();
        if (searchNote.length > 0) {
            $.ajax({
                url: baseURL + 'home/searchNote',
                method: 'POST',
                data: {
                    searchNote: searchNote
                },
                success: function(response) {
                    $('#search-box').css('height', '414px');
                    $('#btnCancelSearch').css('display', 'block');

                    $('#search').empty();

                    if(response.length > 0) {
                        response.forEach(note => {
                            $('#search').append(`
                                <div class="note-box favorite-note">
                                    <div class="note-info">
                                        <p class="note-title">${note.note_title}</p>
                                    </div>
                                    <div class="note" data-id="${note.id}">
                                        <i style="color: ${note.tag_color}; top: -116px;" class="fa-sharp fa-solid fa-bookmark"></i>
                                        <button class="btnMoreNoteOptions" type="button">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        $('#search').append(`
                            <p style="margin: 0px 0px 35px 120px; font-size: 30px; font-weight: bold; color: #b5b5b5;">Nothing...</p>
                        `);  
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                }
            });
        } else {
            $('#search-box').css('height', '0px');
        }
    });

    $('#btnCancelSearch').on('click', function() {
        $('#search-notes-input').val('');
        $('#btnCancelSearch').css('display', 'none');
        $('#search-box').css('height', '0px');
    });
});
