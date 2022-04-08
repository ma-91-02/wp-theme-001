<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Your_MA
 */

?>
<h1></h1>
<footer id="colophon" class="site-footer">
	<?php if (is_active_sidebar('footer-sidebar')) { ?>
		<div class="footer-sidebar"><?php dynamic_sidebar('footer-sidebar'); ?></div><!-- footer-sidebar --> <?php } ?>
	<div class="site-info">
		<a href="<?php echo esc_url(__('https://wordpress.org/', 'ma')); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf(esc_html__('Proudly powered by %s', 'ma'), 'WordPress');
			?>
		</a>
		<span class="sep"> | </span>
		<?php
		/* translators: 1: Theme name, 2: Theme author. */
		printf(esc_html__('Theme: %1$s by %2$s.', 'ma'), 'ma', '<a href="http://underscores.me/">Al-Zurfi Mohamed</a>');
		?>
	</div><!-- .site-info -->
	<?php
	if (has_nav_menu('menu-2')) {
		wp_nav_menu(
			array(
				'theme_location' => 'menu-2',
				'menu_id'        => 'social-menu',
				'container'		=> 'nav',
				'container_class' => 'social',
				'link_before'	=> '<span class="usr_txt">',
				'link_after'	=> '</span>',
			)
		);
	}
	?>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>