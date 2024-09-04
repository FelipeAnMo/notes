<div style="height: 100vh; opacity: 0; transition: opacity 400ms;" id="note-space" class="row-info">
    <div style="width: 400px; height: 68%;" id="note">
    </div>
    <div style="margin-top: 216px;" class="disabled-element" id="tool-box">
        <div id="tool-box-config">
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