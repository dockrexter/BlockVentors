<?php
    $cryptcio_sidebar_left = cryptcio_get_sidebar_left();
    $cryptcio_sidebar_right = cryptcio_get_sidebar_right();

    ?>
<?php if ($cryptcio_sidebar_left && is_active_sidebar($cryptcio_sidebar_left)) : ?>
    <div class="col-md-3 col-sm-12 col-xs-12 left-sidebar "><!-- main sidebar -->
        <?php dynamic_sidebar($cryptcio_sidebar_left); ?>
    </div>
<?php endif; ?>
<?php if ($cryptcio_sidebar_right && is_active_sidebar($cryptcio_sidebar_right)) : ?>
    <div class="col-md-3 col-sm-12 col-xs-12 right-sidebar"><!-- main sidebar -->
        <?php dynamic_sidebar($cryptcio_sidebar_right); ?>
    </div>
<?php endif; ?>





