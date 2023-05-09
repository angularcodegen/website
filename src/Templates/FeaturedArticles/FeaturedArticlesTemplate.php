<?php

namespace CG\Templates\FeaturedArticles;

use WP_Query;

class FeaturedArticlesTemplate
{

    public WP_Query $feature_article_query;
    public WP_Query|null $extra_feature_article_query;
    private int $current_post_id;
    private array $current_post_categories;
    private int $posts_per_page;

    public function __construct()
    {
        add_action('get_footer', array($this, 'register_styles'));

        $this->current_post_id = get_the_ID();
        $this->current_post_categories = wp_get_post_categories($this->current_post_id);
        $this->posts_per_page = 6;

        $this->feature_article_query = $this->get_feature_article_query();
        if ($this->feature_article_query->post_count < $this->posts_per_page) {
            $this->extra_feature_article_query = $this->get_extra_feature_article_query();
        } else {
            $this->extra_feature_article_query = null;
        }
    }

    private function get_feature_article_query(): WP_Query
    {
        return new WP_Query(array(
            'posts_per_page' => $this->posts_per_page,
            'post_type' => 'post',
            'post__not_in' => array($this->current_post_id),
            'category__in' => $this->current_post_categories
        ));
    }

    private function get_extra_feature_article_query(): WP_Query
    {
        return new WP_Query(array(
            'posts_per_page' => $this->posts_per_page - $this->feature_article_query->post_count,
            'post_type' => 'post',
            'category__not_in' => $this->current_post_categories
        ));
    }

    public function render(): void
    {
        require 'FeaturedArticlesTemplate.phtml';
    }

    public function register_styles(): void
    {
        wp_enqueue_style(
            self::class,
            get_theme_file_uri('src/Templates/FeaturedArticles/' . 'FeaturedArticlesTemplate' . '.css')
        );
    }

    public function get_article_template(): string
    {
        return require 'FeatureArticleTemplate.phtml';
    }

}