<?php
function get_breadcrumb()
{
    echo '<ul>';

    // Home link
    if (is_front_page()) {
        $home_title = get_the_title(get_option('page_on_front'));
        echo '<li><span aria-current="page">' . $home_title . '</span></li>';
    } else {
        $home_title = get_the_title(get_option('page_on_front'));
        echo '<li><a href="' . home_url() . '">' . $home_title . '</a></li>';
    }

    // If the page is a single post, show the post title
    if (is_single()) {
        $post_title = get_the_title();
        echo '<li><span aria-current="page">' . $post_title . '</span></li>';
    }
    
     // If the page is posts page, show the page title
    elseif (is_home()) {
        $posts_title = get_the_title( get_option('page_for_posts', true) );
        echo '<li><span aria-current="page">' . $posts_title . '</span></li>';
    }

    // If the page is a page, show the page title and parent pages
    elseif (is_page() && !is_front_page()) {
        $post_title = get_the_title();
        $parent_id = wp_get_post_parent_id(get_the_ID());

        function get_parent_pages($parent_id)
        {
            $parent_title = get_the_title($parent_id);
            $parent_link = get_permalink($parent_id);

            $grandparent_id = wp_get_post_parent_id($parent_id);
            if ($grandparent_id && $grandparent_id != get_option('page_on_front')) {
                get_parent_pages($grandparent_id);
            }

            echo '<li><a href="' . $parent_link . '">' . $parent_title . '</a></li>';
        }

        if ($parent_id) {
            get_parent_pages($parent_id);
        }
        echo '<li><span aria-current="page">' . $post_title . '</span></li>';
    }

    // If the page is a category, show the category name and parent categories
    elseif (is_category()) {
        $category = get_queried_object();
        $ancestors = get_ancestors($category->term_id, 'category');
        $ancestors = array_reverse($ancestors);

        foreach ($ancestors as $ancestor) {
            $ancestor_category = get_category($ancestor);
            echo '<li><a href="' . get_category_link($ancestor_category) . '">' . $ancestor_category->name . '</a></li>';
        }

        echo '<li><span aria-current="page">' . single_cat_title('', false) . '</span></li>';
    }

    // If the page is a search, show the search query
    elseif (is_search()) {
        echo '<li><span aria-current="page">Search results for: ' . get_search_query() . '</span></li>';
    }

    // If the page is an author, show the author name
    elseif (is_author()) {
        $author = get_queried_object();
        echo '<li><span aria-current="page">Author: ' . $author->display_name . '</span></li>';
    }

    echo '</ul>';
}
?>

<nav <?php echo get_block_wrapper_attributes(); ?> aria-label="Breadcrumb"><?php get_breadcrumb(); ?></nav>