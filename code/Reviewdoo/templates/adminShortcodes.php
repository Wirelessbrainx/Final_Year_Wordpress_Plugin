<?php
if (is_admin()) {
    global $shortcode_tags;
    ?>

    <h1>Admin Shortcodes</h1>
    <table>
    <?php foreach ($shortcode_tags as $code => $function) {
        echo "<tr><td>$code</td></tr>";
    }
    ?>
    </table>
<?php } ?>