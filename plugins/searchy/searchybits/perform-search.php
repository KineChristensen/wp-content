  <html>
   	 <head>
	  <meta name="robots" content="noindex, nofollow">
	 </head>
	<body>
	 <?php
	//print_r($_POST);//for your debug
	 
   //INIT CONDITIONS META QUERY
   $array_meta_query=array();
   $array_tax_query=array();
   //ADD SEARCH BY CATEGORIES  CONDITION [checkboxes] - in OR
   if (isset($_POST['categories'])) $chosen_categories=$_POST['categories'];  else $chosen_categories=FALSE;
   if ($chosen_categories)
		 $array_tax_query[]=
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $chosen_categories,
				'operator' => 'IN',
			);

   
   //ADD SEARCH BY TAGS CONDITION -in OR
   if(isset($_POST["tags"]))
   $chosen_tags=$_POST['tags'];  else $chosen_tags=FALSE;
   if ($chosen_tags)
		 $array_tax_query[]=
			array(
				'taxonomy' => 'post_tag',
				'field'    => 'id',
				'terms'    => $chosen_tags,
				'operator' => 'IN',
			);
			
 
   ///CUSTOM FIELD FILTERING - in AND  
   if(isset($_POST["custom-fields"]))
    foreach ($_POST["custom-fields"] as $custom_field_name)
	//air conditioning
	  $array_meta_query[]=
		array(
			'key' => $custom_field_name,
			'value' => 1,
			'type'    => 'numeric',
			'compare' => '=',
		);
	 
  
   //INIT MAIN QUERY AFTER ALL CONDITIONS HAVE BEEN DECLARED
   $args = array(
			  'post_type' => 'post',
			  'post_status'      => 'publish',
			  'posts_per_page'   => 999,
			  'orderby' => $_POST['searchy_sortby_hidden'],
			  'meta_key' =>  $_POST['searchy_sortby_field_hidden'],
			  'order' => 'ASC',
			 //  'orderby' => 'meta_value_num', 'meta_key' => 'price', 
			  'meta_query' => $array_meta_query,
			  'tax_query' => $array_tax_query,
			  //'posts_per_page'   => 5,
			  's' => $_POST['SearchybyName']
			   );
	//SEARCH BY KEYWORD
	
	
	//if (isset($_POST['SearchybyName'])) $args[]= array('s' => $_POST['SearchybyName']);
	 
	 
	//EXECUTE THE QUERY	   
	$myposts = get_posts( $args );
	if ($myposts) { //IF THERE ARE RESULTS
	   ?>
	   
		<h1 class="number-of-results">  <?php echo count($myposts) ?> results found</h1>
		<!-- 
		 <a class="btn btn-default pull-right draw-megamap hidden-xs" href="#" rel="nofollow"><span class="glyphicon glyphicon-map-marker"></span> Show results on Map</a>
		 <a class="btn btn-default pull-right close-megamap hidden" href="#" rel="nofollow"><span class="glyphicon glyphicon-remove"></span> Hide Map</a>    
		 <div class="clearfix"></div>									
		 <div id='multimap' class="hidden"  ></div>
		-->
		
		<?php
		
	  foreach ( $myposts as $post ) :
		 
		 //call templating function 
		searchy_display_post_element($post);
		 
	  endforeach; 
	  wp_reset_postdata();
	  }
	  
	  else { include("no-results.php");  }
	?>
	</body>
</html>