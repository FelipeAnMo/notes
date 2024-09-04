    <?php if(isset($id) && empty(stripos($_SERVER['REQUEST_URI'], "note"))): ?>
        <footer>

        </footer>
    <?php endif; ?>
    </section>
    <div id="logout-modal">
        <button type="button" id="btnLogout">Logout</button>
    </div>

    <div id="delete-account-modal">
        <button type="button" id="btnDeleteAccount">Delete account</button>
    </div>

    <?php if(isset($scripts) && is_array($scripts)): ?>
        <?php foreach ($scripts as $script): ?>
            <script src="<?= $script ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if(isset($styles) && is_array($styles)): ?>
        <?php foreach ($styles as $style): ?>
            <link rel="stylesheet" href="<?= $style ?>"></link>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>