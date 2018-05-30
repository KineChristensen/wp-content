 
<!-- start sidebar tools -->
<div id="searchy-filter-overlayer"></div>
<form class="searchy-search-form" method="post">
   
  <div class="form-group" id="searchy-by-name">
	<label for="SearchybyName"><span class="glyphicon glyphicon-pencil"></span> Search by Name</label>
	<input type="text" class="form-control" id="SearchybyName" name="SearchybyName" placeholder="Enter Title...">
  </div>
  
  <div class="form-group" id="searchy-by-cat">
	 <label for="SearchybyCat"><span class="glyphicon glyphicon-globe"></span> Filter by Categories</label>
   <?php 
	 $all_categories = get_categories();
	  if ($all_categories) foreach ( $all_categories as $category )
	  {
	 ?>
   <div class="checkbox">
	<label><input type="checkbox" name="categories[]" value="<?php echo $category->cat_ID ?>"> <?php echo $category->cat_name ?></label>
	</div>
   <?php 
		  
	  } ?>

  </div> <!-- close FORM GROUP -->
	   

  <div class="form-group" id="searchy-by-tag">
	  <label for="SearchybyTag"><span class="glyphicon glyphicon-tree-deciduous"></span> Filter By Tags</label>
	   <?php 
		 $tags = get_tags();
		 
		  if ($tags) foreach ( $tags as $tag ) {
				// if ($tag->term_id==999) continue;
				 ?>
			   <div class="checkbox">
				 <label><input type="checkbox" name="tags[]" value="<?php echo $tag->term_id ?>"> <?php echo $tag->name ?></label>
				</div>
			   <?php 
			  
		  } ?>
  </div> <!-- close FORM GROUP -->
  
  
  <?php if(get_option( 'sy_custom_fields_list' )!=''): ?>
  <div class="form-group" id="searchy-by-cf">
	 <label for="SearchybyCFs"><span class="glyphicon glyphicon-th-large"></span> Filter By Custom Fields</label>
	  
	  <!--
	  <div class="checkbox">
		<label><input type="checkbox" <?php if (isset($_GET['air-conditioning'])):?> checked="checked" <?php endif ?> name="custom-fields[]" value="air-conditioning">Air conditioning</label>
	  </div>
	  -->
	  <?php
	  $custom_fields_setting = preg_split('/\n|\r\n?/', get_option( 'sy_custom_fields_list' ));
      foreach($custom_fields_setting as $cf_name):
        if ($cf_name=="") continue;
		?>
	  <div class="checkbox">
		<label><input type="checkbox" <?php if (isset($_GET[$cf_name])):?> checked="checked" <?php endif ?> name="custom-fields[]" value="<?php echo $cf_name ?>"> <?php echo ucwords(str_replace('-',' ',$cf_name)); ?></label>
	  </div>
		 <?php endforeach ?>
		   
  </div> <!-- close FORM GROUP -->
  <?php endif ?>
  
  
  <input type="hidden" name="searchy_ajax_results" value="1">
  <input type="hidden" name="searchy_sortby_hidden" value="">
  <input type="hidden" name="searchy_sortby_field_hidden" value="">
  <button type="submit" class="btn btn-primary searchy-trigger-search">Search!</button>
   
	  
</form>
<!-- end sidebar tools -->