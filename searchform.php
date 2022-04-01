<?php

$action = esc_url(home_url('/'));
$placeholder = esc_attr_x('Search &hellip;', 'placeholder');
$query = get_search_query();
$submit = esc_attr_x('Search', 'submit button');
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
        <input type="search" class="search-field" placeholder="<?= $placeholder ?>" value="<?= $query ?>" name="s"
               autocomplete="off"/>
    </label>
    <button type="submit" class="search-submit"><?= $submit ?></button>
</form>