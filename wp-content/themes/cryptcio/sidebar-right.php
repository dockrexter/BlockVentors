<?php
    $cryptcio_sidebar_right = cryptcio_get_sidebar_right();
    ?>
<?php if ($cryptcio_sidebar_right && $cryptcio_sidebar_right != "none" && is_active_sidebar($cryptcio_sidebar_right)) : ?>
    <div class="col-md-3 col-sm-12 col-xs-12 right-sidebar active-sidebar"><!-- main sidebar -->
        <?php dynamic_sidebar($cryptcio_sidebar_right); ?>
    </div>
<?php endif; ?>


