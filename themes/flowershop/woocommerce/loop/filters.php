<?php
/**
 * Filters sidebar with button toggle
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if (is_active_sidebar('flowershop-sidebar-filters')) : ?>

<div class="filter-area">

	<button class="btn btn-default btn-archive-filters" data-toggle="modal" data-target="#archive-filters">
		<span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
		<?php	_e( 'Filter Products', 'flowershop' );
		?>
	</button>

	<?php
		$filterreset = $_SERVER['REQUEST_URI'];

		if ( strpos($filterreset,'?filter_') !== false | strpos($filterreset,'?min_price') !== false | strpos($filterreset,'?max_price')) : ?>

		<?php
			$filterreset = strtok($filterreset, '?');
		?>

	 	<a class="btn btn-link btn-archive-clear-filters" href="<?php echo esc_url($filterreset); ?>">
			<?php	_e( 'Clear Filters', 'flowershop' ); ?>
		</a>

	 <?php endif; ?>



		 <!-- Modal -->
		 <div class="modal fade" id="archive-filters" tabindex="-1" role="dialog" aria-labelledby="archive-filters-Label">
			 <div class="modal-dialog" role="document">
				 <div class="modal-content">
					 <div class="modal-header">
						 <button type="button" class="close" data-dismiss="modal" aria-label="<?php esc_html_e( 'Close', 'flowershop' ) ?>"><span aria-hidden="true">&times;</span></button>
						 <h4 class="modal-title" id="archive-filters-Label"><?php	_e( 'Filter Products', 'flowershop' ); ?></h4>
					 </div>
					 <div class="modal-body">
						 <?php dynamic_sidebar('flowershop-sidebar-filters'); ?>
					 </div>
				 </div>
			 </div>
		 </div>


</div>

 <?php endif; ?>
