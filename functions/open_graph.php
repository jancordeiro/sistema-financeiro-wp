// Open Graph TAGs. Colar esse script no arquivo 'headers.php' dentro do <head>

<?php
if (is_singular()) {
    global $post;

    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
    $thumbnail_url = $thumbnail ? $thumbnail[0] : '';

    $og_tags = array(
        '<meta property="og:title" content="' . get_the_title() . '">',
        '<meta property="og:url" content="' . get_permalink() . '">',
        '<meta property="og:type" content="article">',
        '<meta property="og:description" content="' . get_the_excerpt() . '">',
        '<meta property="og:image" content="' . $thumbnail_url . '">'
    );

    echo implode("\n", $og_tags);
}
?>
