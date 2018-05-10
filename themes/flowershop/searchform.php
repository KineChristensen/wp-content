<?php
/**
 * Search Form
 *
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package flowershop
 */
?>

<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url(home_url( '/' )); ?>">

	 <div class="form-group">

	  <label class="screen-reader-text sr-only"><span><?php echo esc_html_x( 'Search for:', 'label', 'flowershop' ) ?></span></label>

	  <input type="search"  class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder','flowershop' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for', 'label','flowershop'  ); ?>" />

		<button class="btn btn-link" type="submit" aria-label="<?php echo esc_attr_x( 'Search', 'submit button', 'flowershop' ); ?>" title="<?php echo esc_attr_x( 'Search', 'submit button', 'flowershop' ); ?>">
	      <i class="glyphicon glyphicon-search"></i>
	  </button>

	</div>

</form>