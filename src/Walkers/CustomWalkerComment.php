<?php

namespace CG\Walkers;

use Walker_Comment;

class CustomWalkerComment extends Walker_Comment
{

    public function end_el(&$output, $data_object, $depth = 0, $args = array()): void
    {
        $output .= "</li>";
    }

    protected function html5_comment($comment, $depth, $args): void
    {
        $commenter = wp_get_current_commenter();
        $show_pending_links = !empty($commenter['comment_author']);

        if ($commenter['comment_author_email']) {
            $moderation_note = __('Your comment is awaiting moderation.');
        } else {
            $moderation_note = __('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.');
        }
        ?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class($this->has_children ? 'parent' : '', $comment); ?>>
        <article id="comment-<?php comment_ID(); ?>" class="comment-body">
            <div class="comment-author vcard">
                <?php
                if (0 != $args['avatar_size']) {
                    echo get_avatar($comment, $args['avatar_size']);
                }
                ?>

            </div>
            <div class="content">

                <header class="comment-metadata">
                    <?php
                    $comment_author = get_comment_author_link($comment);

                    if ('0' === $comment->comment_approved && !$show_pending_links) {
                        $comment_author = get_comment_author($comment);
                    }

                    printf(
                        sprintf('<span class="author">%s</span>', $comment_author)
                    );
                    ?>

                    <a href="<?= get_comment_link($comment, $args) ?>" style="font-size: .8rem">
                        <time datetime="<?= get_comment_time('c') ?>">
                            <?= human_time_diff(get_comment_time('U')) ?>
                            <?= __('ago', 'cg') ?>
                        </time>
                    </a>
                </header>

                <div class="comment-content">
                    <?php comment_text(); ?>
                </div>

                <?php if ('0' === $comment->comment_approved) : ?>
                    <em class="comment-awaiting-moderation"
                        style="margin-top: 10px; display: inline-block"><?php echo $moderation_note; ?></em>
                <?php endif; ?>

                <footer class="comment-actions">
                    <?php
                        if ('1' === $comment->comment_approved || $show_pending_links):
                            comment_reply_link(
                                array_merge(
                                    $args,
                                    array(
                                        'add_below' => 'div-comment',
                                        'depth' => $depth,
                                        'max_depth' => $args['max_depth'],
                                        'before' => '<div class="reply">',
                                        'after' => '</div>',
                                    )
                                )
                            );
                        endif;

                        edit_comment_link(__('Edit'), ' <span class="edit-link">', '</span>');
                    ?>
                </footer>
            </div>


        </article>
        <?php
    }


}