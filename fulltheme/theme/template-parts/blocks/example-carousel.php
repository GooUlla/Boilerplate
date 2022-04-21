<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'carousel-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'carousel';
if (!empty($block['className'])) {
  $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
  $className .= ' align' . $block['align'];
}


?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  <?php if (have_rows('galeria')) : ?>
    <div class="slides">
      <?php while (have_rows('galeria')) : the_row(); ?>
      <?php $pags[] = get_sub_field('titulo'); ?>
        <div class="slide">
          <img class="" src="<?php the_sub_field('imagen'); ?>" />
        </div>
      <?php endwhile; ?>
    </div>
    <div class="pagination">
      <?php foreach ($textos as $texto) : ?>
        <span class=""><?php echo $texto; ?></span>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>