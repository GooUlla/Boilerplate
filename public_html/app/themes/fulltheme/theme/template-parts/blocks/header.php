<?php

/**
 * Header Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 */


// Create class attribute allowing for custom "className" and "align" values.
$className = 'header';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.

?>
<div id="masthead" class="<?php echo esc_attr($className); ?>">
  <?php the_custom_logo(); ?>
  <div id="main-menu" class="">
    <?php the_field('menu'); ?>
  </div>
  <div id="hamburger" class="flex relative z-[99999999] items-center justify-center w-8 h-8 cursor-pointer md:hidden"><span></span><span></span><span></span></div>
</div>