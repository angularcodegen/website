<?php

$action = esc_url(home_url('/'));
$placeholder = esc_attr_x('Search &hellip;', 'placeholder');
$query = get_search_query();
$autofocus = is_404() || is_search();
?>

<style>
    .search-form {
        display: flex;
        flex-wrap: nowrap;
    }

    .search-form > label {
        width: 100%;
    }

    .search-form input {
        padding: 1rem;
        font-size: 1.2rem;
    }

    .search-form button {
        background: black;
        border: #3a3b3c 1px solid;
        border-left: 0;
        padding: 0 20px;
    }
</style>

<form role="search" method="get" class="search-form" action="<?= $action ?>">
    <label>
        <input
            <?= $autofocus ? 'autofocus' : '' ?>
                type="search"
                class="search-field"
                placeholder="<?= $placeholder ?>"
                value="<?= $query ?>"
                name="s"
                autocomplete="off"
        />
    </label>
    <button type="submit" class="search-submit">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
             viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
    </button>
</form>

<style>
    .terms {
        display: flex;
        gap: .5rem;
        list-style: none;
        padding: 0;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .terms a {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: .75em;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
        background-color: rgb(47 51 55 / 80%);
    }
</style>

<?php
$tags = get_tags();
$cats = get_categories();
$terms = array_merge($cats, $tags);
?>

<ul class="terms">
    <?php foreach ($terms as $term): ?>
        <li>
            <a href="<?= get_term_link($term->term_id) ?>">
                <?= $term->name ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

