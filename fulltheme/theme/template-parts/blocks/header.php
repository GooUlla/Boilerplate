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
  <!-- Content -->
</div>