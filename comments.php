<?php


use CG\Walkers\CustomWalkerComment;

if (post_password_required()):
    return;
endif;

?>

<style>

    #reply-title {
        margin-top: 60px;
    }

    .comment-body {
        display: flex;
    }

    .comment-body .author {
        font-weight: 700;
    }

    .comment-body .content {
        background: #3A3B3C;
        border-radius: 18px;
        padding: 8px 12px;
        flex-grow: 2;
    }

    .comment-author.vcard {
        margin-right: 8px;
    }

    .comment-list {
        list-style: none;
        padding-left: 0;
    }

    .comment-list > li {
        margin-top: 45px;
    }

    .comment-list .children > li {
        margin-top: 45px;
        list-style: none;
    }

    .comment-list .children > li {
        list-style: none;
        margin-top: 20px;
    }

    .comment-body img.avatar.photo {
        border-radius: 50%;
    }

    #submit {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }

    #cancel-comment-reply-link {
        margin-left: 50px;
    }

</style>

<div class="container comments-area">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title"><?= __('Komentarze', 'cg') ?></h2>

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
        </ol><

    <?php endif; ?>

    <?php comment_form(); ?>

</div>