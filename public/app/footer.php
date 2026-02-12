<footer class="main-footer">
    <div class="footer-container">
        <p>© 2026 Hidrogena · Hidrógeno Verde</p>
        <!-- Short Echo Tag en PHP, necesita al menos PHP 5.4+ -->
        <p><?= $translations['financiado_gob'] ?></p>

        <div class="socials">
            <a href="https://instagram.com" target="_blank">Instagram</a>
            <a href="https://facebook.com" target="_blank">Facebook</a>
            <a href="https://twitter.com" target="_blank">X</a>
            <a href="https://youtube.com" target="_blank">YouTube</a>
        </div>

        <div class="links">
            <a href="#"><?= $translations['terms'] ?></a>
            <a href="#"><?= $translations['privacy'] ?></a>
            <a href="#"><?= $translations['safety'] ?></a>
        </div>

        <p>&copy; <span id="year"></span> <?= $translations['hidrogeno_verde'] ?>. <?= $translations['all_rights'] ?></p>
    </div>
</footer>

<script src="js/main.js"></script>
</body>
</html>