<div id="header-note" style="display: flex; justify-content: space-between;" class="row-info">
    <div id="myNoteH3">
        <h3>My notes</h3>
    </div>
    <div id="title-container">
        <input type="text" id="note-title" placeholder="Note title..." spellcheck="false" value="<?php echo !empty($noteContent['note_title']) ? $noteContent['note_title'] : ""; ?>">
        <span id="input-sizer"></span>
    </div>
    <div id="box-btnSave">
        <button type="button" class="btnSaveNote">Save</button>
    </div>
    <button type="button" id="btnShowHeader">
        <i class="fa-solid fa-bars"></i>
    </button>
</div>
<div id="note-space" class="row-info">
    <div class="disabled-element-mobile" id="tool-box">
        <div id="tool-box-config">
            <button style="background-color: <?= $noteContent['tag_color']; ?>;" type="button" class="btnTag"></button>
            <button type="button" class="ql-bold btnFontSelector" aria-pressed="false" aria-label="bold">
                <i class="fa-solid fa-font"></i>
            </button>
            <button type="button" class="btnTextBold">
                <i class="fa-solid fa-bold"></i>
            </button>
            <button type="button" class="btnTextItalic">
                <i class="fa-solid fa-italic"></i>
            </button>
            <button type="button" class="btnTextUnderline">
                <i class="fa-solid fa-underline"></i>
            </button>
        </div>
    </div>
    <div id="note">
        <?php echo !empty($noteContent['note_text']) ? $noteContent['note_text'] : ""; ?>
    </div>
    <div class="disabled-element" id="tool-box">
        <div id="tool-box-config">
            <button style="background-color: <?= $noteContent['tag_color']; ?>;" type="button" class="btnTag"></button>
            <button type="button" class="ql-bold btnFontSelector" aria-pressed="false" aria-label="bold">
                <i class="fa-solid fa-font"></i>
            </button>
            <button type="button" class="btnTextBold">
                <i class="fa-solid fa-bold"></i>
            </button>
            <button type="button" class="btnTextItalic">
                <i class="fa-solid fa-italic"></i>
            </button>
            <button type="button" class="btnTextUnderline">
                <i class="fa-solid fa-underline"></i>
            </button>
        </div>
    </div>
</div>
<div style="display: flex; justify-content: right; padding: 0 0 30px 0;" class="row-info">
    <div id="save-mobile">
        <button type="button" class="btnSaveNote">Save</button>
    </div>
</div>
<div class="modal-text-config">
    <div class="custom-select">
        <div class="select-selected"><?php echo !empty($noteContent['font_family']) ? $noteContent['font_family'] : "Playwrite D. G."; ?></div>
        <div class="select-items select-hide">
            <div class="select-item" data-value="PlaywriteDG">Playwrite D. G.</div>
            <div class="select-item" data-value="Roboto">Roboto</div>
            <div class="select-item" data-value="OpenSans">Open Sans</div>
            <div class="select-item" data-value="PlaywriteAR">Playwrite A.</div>
            <div class="select-item" data-value="Arial">Arial</div>
            <div class="select-item" data-value="TimesNewRoman">Times New Roman</div>
        </div>
    </div>
</div>
<div class="modal-tag-color">
    <div class="tag-color-presets">
        <div class="preset-color" id="preset-color-1"></div>
        <div class="preset-color" id="preset-color-2"></div>
        <div class="preset-color" id="preset-color-3"></div>
        <div class="preset-color" id="preset-color-4"></div>
    </div>
    <div class="box-input-tag-color">
        <input id="input-tag-color" type="text" placeholder="#000000" maxlength="7">
        <button id="btnApplyTagColor" type="button">
            <i class="fa-solid fa-arrow-right"></i>
        </button>
    </div>
</div>