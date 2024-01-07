<?php
namespace CG\Integrations\Acf\Blocks\CodePreview;

use CG\Core\AppLogger;

class CodePreviewCron
{
    public static \Monolog\Logger $logger;
    private const ACTION = 'FORMAT_AND_HIGHLIGHT_CODE';

    public function __construct()
    {
        add_action(self::ACTION, array($this, 'format_and_highlight_code'));
    }

    public static function register_new_cron_for_block($post_id)
    {

        if (wp_next_scheduled(self::ACTION, [$post_id])) {
            return;
        }

        $error = wp_schedule_single_event(time(), self::ACTION, [$post_id], true);

        if (is_wp_error($error)) {
            self::$logger->warning('Cron failed to run', [
                "post_id" => $post_id,
            ]);

        }
    }

    public function format_and_highlight_code($post_id)
    {
        $post_content = get_the_content(null, false, $post_id);
        $has_block = has_block(CodePreviewBlock::NAME, $post_content);

        if (false === $has_block) {
            self::$logger->warning('Post does not have block to format', [
                "post_id" => $post_id,
            ]);

            return;
        }



        $parsed = parse_blocks($post_content);
        foreach ($parsed as &$block) {
            $this->format_and_highlight_block($block);
        }

        $new_post_content = serialize_blocks($parsed);

        wp_update_post(
            array(
                'ID' => $post_id,
                'post_content' => wp_slash($new_post_content),
            )
        );
    }

    private function format_and_highlight_block(mixed &$block): void
    {
        foreach ($block['innerBlocks'] as &$innerBlock) {
            $this->format_and_highlight_block($innerBlock);
        }

        if ($block['blockName'] === CodePreviewBlock::NAME) {
            $language = $block['attrs']['data']['593D265269114F70B5E116DB58AF9BE5'];
            $code = $block['attrs']['data']['8E9300D01F9547E781F8F7DE5DCA0742'];

            $formatted = CodePreviewHttp::format($language, $code);
            $highlighted = CodePreviewHttp::highlight($language, $formatted);


            $block['attrs']['data']['8E9300D01F9547E781F8F7DE5DCA0742'] = $formatted;
            $block['attrs']['data']['E3CBDF3F888B1896576C840F04586E24'] = $highlighted;
        }

    }
}

CodePreviewCron::$logger = AppLogger::getLogger()->withName('CodePreviewCron');