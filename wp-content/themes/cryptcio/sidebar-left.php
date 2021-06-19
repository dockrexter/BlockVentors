<?php
    $cryptcio_sidebar_left = cryptcio_get_sidebar_left();
?>
<?php if ($cryptcio_sidebar_left && $cryptcio_sidebar_left != "none" && is_active_sidebar($cryptcio_sidebar_left)) : ?>
    <div class="col-md-3 col-sm-12 col-xs-12 left-sidebar active-sidebar"><!-- main sidebar -->
        <?php dynamic_sidebar($cryptcio_sidebar_left); ?>
    </div>
<?php endif; ?>


