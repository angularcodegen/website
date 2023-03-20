<?php


use CG\Walkers\CustomWalkerComment;

if (post_password_required()):
    return;
endif;

?>


<div class="container comments-area">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title"><?= __('Comments', 'cg') ?></h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'walker' => new CustomWalkerComment(),
                    'short_ping' => true,
                    'style' => 'ol',
                )
            );
            ?>
        </ol>

    <?php endif; ?>

    <?php comment_form(); ?>

</div>