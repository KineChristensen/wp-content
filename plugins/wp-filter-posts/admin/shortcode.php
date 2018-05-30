<?php 
if (!defined( 'ABSPATH' ))
    exit;
function xyz_wpf_shortcode($params)
{
    global $wpdb;
    $filterid="";
    $count_query_limit = array();
    $Array_cat_vals="";
    $Array_tag_vals="";
    if(isset($params['id']))
        $filterid=$params['id'];
    $filter_detials=$wpdb->get_row($wpdb->prepare("SELECT * FROM `".$wpdb->prefix."xyz_wp_posts_filter` WHERE `id`=%d",$filterid));
    $xyz_wpf_categories=$filter_detials->xyz_wpf_categories;
    $xyz_wpf_cat_post_from=$filter_detials->xyz_wpf_cat_post_from;
    $xyz_wpf_tags=$filter_detials->xyz_wpf_tags;
    $xyz_wpf_tag_post_from=$filter_detials->xyz_wpf_tag_post_from;
    $xyz_wpf_authors=$filter_detials->xyz_wpf_authors;
    $xyz_wpf_no_of_posts=$filter_detials->xyz_wpf_no_of_posts;
    $xyz_wpf_skip_posts=$filter_detials->xyz_wpf_skip_posts;
    $xyz_wpf_pagination=$filter_detials->xyz_wpf_pagination;
    $xyz_wpf_pagination_limit=$filter_detials->xyz_wpf_pagination_limit;
    $xyz_wpf_sort=$filter_detials->xyz_wpf_sort;
    $xyz_wpf_order=$filter_detials->xyz_wpf_order;
    $xyz_wpf_msg_format=$filter_detials->xyz_wpf_msg_format;
    $xyz_wpf_status=$filter_detials->xyz_wpf_status;
    if($xyz_wpf_status==1)
    {
        $Array_cat_vals = explode(',', $xyz_wpf_categories);
        $Array_tag_vals = explode(',', $xyz_wpf_tags);
        if($xyz_wpf_categories=="")
            $Array_cat_vals="";
        if($xyz_wpf_tags=="")
            $Array_tag_vals="";
        if($xyz_wpf_order==0)
            $ordr='ASC';
        else $ordr='DESC';
        if($xyz_wpf_sort==0)
            $sort='date';
        else $sort='modified';
        $pagenum = isset( $_GET['pagenum'.$filterid] ) ? absint( $_GET['pagenum'.$filterid] ) : 1;
        if($xyz_wpf_no_of_posts>0)
            $count_query_limit = array(
            'showposts'=> $xyz_wpf_no_of_posts
        );
        if($xyz_wpf_cat_post_from==0 && $xyz_wpf_tag_post_from==0)
        {
            $max_count=new WP_Query(array_merge($count_query_limit, array( 'category__in' => $Array_cat_vals, 'tag__in' => $Array_tag_vals, 'author' =>$xyz_wpf_authors, 'offset' => $xyz_wpf_skip_posts,'orderby' => $sort, 'order' => $ordr))   );
        }
        else if($xyz_wpf_cat_post_from==1 && $xyz_wpf_tag_post_from==0)
        {
            $max_count=new WP_Query(array_merge($count_query_limit,array( 'category__and' => $Array_cat_vals, 'tag__in' => $Array_tag_vals, 'author' =>$xyz_wpf_authors, 'offset' => $xyz_wpf_skip_posts,'orderby' => $sort, 'order' => $ordr)) );
        }
        else if($xyz_wpf_cat_post_from==0 && $xyz_wpf_tag_post_from==1)
        {
            $max_count=new WP_Query(array_merge($count_query_limit,array( 'category__in' => $Array_cat_vals, 'tag__and' => $Array_tag_vals, 'author' =>$xyz_wpf_authors,  'offset' => $xyz_wpf_skip_posts,'orderby' => $sort, 'order' => $ordr)) );
        }
        else if($xyz_wpf_cat_post_from==1 && $xyz_wpf_tag_post_from==1)
        {
            $max_count= new WP_Query(array_merge($count_query_limit,array( 'category__and' => $Array_cat_vals, 'tag__and' => $Array_tag_vals, 'author' =>$xyz_wpf_authors,  'offset' => $xyz_wpf_skip_posts,'orderby' => $sort, 'order' => $ordr )) );
        }
        $max_count1=$max_count->posts;
        $total = count($max_count1);
        if($xyz_wpf_no_of_posts==0 )
        {
            $limit=$xyz_wpf_pagination_limit;
            $query_limit=$limit;
        }
        else if($xyz_wpf_pagination_limit==0)
        {
            $limit=$xyz_wpf_no_of_posts;
            $query_limit=$limit;
        }
        else if($xyz_wpf_pagination_limit<$xyz_wpf_no_of_posts)
        {
            $limit=$xyz_wpf_pagination_limit;
            $query_limit=$limit;
        }
        else
        {
            $limit =$xyz_wpf_no_of_posts;
            $query_limit=$limit;
        }
        if($limit!=0)
            $num_of_pages = ceil( $total / $limit );
        else
            $num_of_pages=1;
        if($pagenum>$num_of_pages)
            $pagenum = $num_of_pages;
        if(($xyz_wpf_pagination_limit!=0)&&($xyz_wpf_no_of_posts!=0)&&($xyz_wpf_pagination_limit<$xyz_wpf_no_of_posts))
        {
            $last_page_num=ceil($total/$limit);
            if($pagenum==$last_page_num)
            {
                $last_post_count=$total%$limit;
                if($last_post_count!=$limit)
                    $query_limit=$last_post_count;
            }
        }
        $offset = (( $pagenum - 1 ) * $limit)+$xyz_wpf_skip_posts;
        
        if($xyz_wpf_cat_post_from==0 && $xyz_wpf_tag_post_from==0)
        {
            $query1 = new WP_Query(array( 'category__in' => $Array_cat_vals, 'tag__in' => $Array_tag_vals, 'author' =>$xyz_wpf_authors,  'showposts' => $query_limit,  'offset' => $offset, 'orderby' => $sort, 'order' => $ordr)  );
        }
        else if($xyz_wpf_cat_post_from==1 && $xyz_wpf_tag_post_from==0)
        {
            $query1 = new WP_Query(array( 'category__and' => $Array_cat_vals, 'tag__in' => $Array_tag_vals, 'author' =>$xyz_wpf_authors,  'showposts' => $query_limit,  'offset' => $offset, 'orderby' => $sort, 'order' => $ordr) );
        }
        else if($xyz_wpf_cat_post_from==0 && $xyz_wpf_tag_post_from==1)
        {
            $query1 = new WP_Query(array(  'category__in' => $Array_cat_vals, 'tag__and' => $Array_tag_vals, 'author' =>$xyz_wpf_authors,  'showposts' => $query_limit, 'offset' => $offset, 'orderby' => $sort, 'order' => $ordr) );
        }
        else if($xyz_wpf_cat_post_from==1 && $xyz_wpf_tag_post_from==1)
        {
            $query1 = new WP_Query(array(  'category__and' => $Array_cat_vals, 'tag__and' => $Array_tag_vals, 'author' =>$xyz_wpf_authors,  'showposts' => $query_limit,  'offset' => $offset, 'orderby' => $sort, 'order' => $ordr ) );
        }
        if($query1->have_posts())
        {
            $query=$query1->posts;

            $page_links = paginate_links( array(
                'base' => add_query_arg( 'pagenum'.$filterid,'%#%'),
                'format' => '',
                'prev_text' =>  '&laquo;',
                'next_text' =>  '&raquo;',
                'total' => $num_of_pages,
                'current' => $pagenum
            ) );
            $final_output="";
            if( count($query)>0 )
            {
                foreach ($query as $querypost)
                {
                    $permalink=get_permalink($querypost->ID ); 
                    $user_nicename=$wpdb->get_row($wpdb->prepare("SELECT  `user_nicename` FROM `".$wpdb->base_prefix."users` WHERE `ID`=%d",$querypost->post_author));
                    $image_link = wp_get_attachment_url( get_post_thumbnail_id($querypost->ID) );
                    $posttags=wp_get_post_tags($querypost->ID);
                    $postcats=get_the_category( $querypost->ID );
                    $date_format = get_option('date_format');
                   	$postpub = date($date_format, strtotime($querypost->post_date));
                    $postupd = date($date_format, strtotime($querypost->post_modified));
                    $tagar='';
                    if ($posttags) 
                    {
                        foreach($posttags as $tag) 
                        {
                            $linktag = get_tag_link( $tag->term_id);
                            $tagar.="<a href='$linktag'>$tag->name</a> ";
                        }
                    }
                    $catar='';
                    if ($postcats) 
                    {
                        foreach($postcats as $cat)
                        {
                            $linkcat = get_category_link( $cat->term_id);
                            $catar.="<a href='$linkcat'>$cat->name</a> ";
                        }
                    }
                    $message=$xyz_wpf_msg_format;
                    $name = html_entity_decode(get_the_title($querypost->ID ), ENT_QUOTES, get_bloginfo('charset'));
                    $name ="<a href='$permalink'>$name</a>"; 
                    $caption = html_entity_decode(get_bloginfo('title'), ENT_QUOTES, get_bloginfo('charset'));
                    $link=$permalink;
                    $description=html_entity_decode(apply_filters('the_content',$querypost->post_content), ENT_QUOTES, get_bloginfo('charset'));
                    //	$description=apply_filters('the_content',$querypost->post_content);
                    $excerpt=html_entity_decode(apply_filters('the_excerpt',$querypost->post_excerpt), ENT_QUOTES, get_bloginfo('charset'));//$querypost->post_excerpt; 
                    //$description=strip_shortcodes($description);
                    //$description=str_replace("&nbsp;","",$description);
                    $POST_PUBLISH_DATE ="<a href='$permalink'>$postpub</a>"; 
                    $POST_UPDATE_DATE ="<a href='$permalink'>$postupd</a>"; 
                    $user_nicename=$user_nicename->user_nicename;
                    $post_ID=$querypost->ID;
                    $post_tags=$tagar;
                    $POST_CATEGORY=$catar;
                    $POST_FEATURED_IMAGE='<img src='.$image_link.' height="160" width="160">';
                    $message1=str_replace('{POST_TITLE}', $name, $message);
                    $message2=str_replace('{BLOG_TITLE}', $caption,$message1);
                    $message3=str_replace('{PERMALINK}', $link, $message2);
                    $message4=str_replace('{POST_EXCERPT}', $excerpt, $message3);
                    $message5=str_replace('{POST_CONTENT}', $description, $message4);
                    $message5=str_replace('{USER_NICENAME}', $user_nicename, $message5);
                    $message5=str_replace('{POST_ID}', $post_ID, $message5);
                    $message5=str_replace('{POST_TAGS}', $post_tags, $message5);
                    $message5=str_replace('{POST_CATEGORY}', $POST_CATEGORY, $message5);
                    $message5=str_replace('{POST_FEATURED_IMAGE}',$POST_FEATURED_IMAGE, $message5);
                    $message5=str_replace('{POST_PUBLISH_DATE}',$POST_PUBLISH_DATE, $message5);
                    $message5=str_replace('{POST_UPDATE_DATE}',$POST_UPDATE_DATE, $message5);
                    $final_output.=$message5;
                }		
            }
            if ( $page_links )
            {
                $final_output.= '<div class="tablenav" style="width:99%"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
            }
            return do_shortcode($final_output);
        }
        else 
            return "Sorry, no posts matched your criteria.";
    }
}
