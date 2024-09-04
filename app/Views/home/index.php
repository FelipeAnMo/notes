<div id="row-title" class="row-info">
    <h3>My notes</h3>
    <input type="text" id="search-notes-input" placeholder="Search...">
    <button id="btnSearchNotes">
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>
    <button type="button" id="btnCancelSearch">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <button type="button" id="btnShowHeader">
        <i class="fa-solid fa-bars"></i>
    </button>
</div>
<div id="search-box">
    <div id="favorites-info" class="note-align">
        <i id="search-icon" class="fa-solid fa-magnifying-glass"></i>
        <h4 id="favorites-title">Search</h4>
        <div id="division-line"></div>
    </div>
    <div id="search" class="row note-align"></div>
</div>
    <div id="favorites-info" class="note-align">
        <i id="favorites-icon" class="fa-solid fa-star"></i>
        <h4 id="favorites-title">Favorites</h4>
        <div id="division-line"></div>
    </div>
    <div id="favorites" class="row note-align">
    <?php foreach($favorite_notes as $note) { ?>
        <div class="note-box favorite-note">
            <div class="note-info">
                <p class="note-title"><?= $note['note_title']; ?></p>
                <button class="star-button" data-id="<?= $note['id']; ?>">
                    <i class="fa-solid fa-star"></i>
                </button>
            </div>
            <div class="note" data-id="<?= $note['id']; ?>">
                <i style="color: <?= $note['tag_color'] ?>" class="fa-sharp fa-solid fa-bookmark"></i>
                <button class="btnMoreNoteOptions" type="button">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
            </div>
        </div>
    <?php } ?> 
    </div>
    <div id="favorites-info" class="note-align">
        <i id="other-notes-icon" class="fa-solid fa-note-sticky"></i>
        <h4 id="other-notes-title">Notes</h4>
        <div id="division-line"></div>
        <button type="button" id="note-add">
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>
    <div class="row note-align">
    <?php foreach($notes as $note) { ?>
        <div class="note-box">
            <div class="note-info">
                <p class="note-title"><?= $note['note_title']; ?></p>
                <button class="star-button" data-id="<?= $note['id']; ?>">
                    <i class="<?php echo $note['favorite'] ? "fa-solid" : "fa-regular" ?> fa-star"></i>
                </button>
            </div>
            <div class="note" data-id="<?= $note['id']; ?>">
                <i style="color: <?= $note['tag_color'] ?>" class="fa-sharp fa-solid fa-bookmark"></i>
                <button class="btnMoreNoteOptions" type="button">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
            </div>
        </div>
    <?php } ?>
    </div>
<div class="modal-delete-note">
    <button class="btnDeleteNote" type="button">Delete</button>
</div>