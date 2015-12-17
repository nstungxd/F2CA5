<?php
add_theme_support ( 'nav-menus' );
add_theme_support ( 'post-thumbnails' );
register_nav_menus ( array (
		'main_top' => __ ( 'Menu chính ở trên' ) 
) );
register_sidebar ( array (
		'id' => 'sidebar_widget',
		'name' => 'Sidebar',
		'before_widget' => '<div class="section">
								<div class="secondaryContent">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>' 
) );
class BootstrapNavMenuWalker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth) {
		$indent = str_repeat ( "\t", $depth );
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		$output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
	}
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$indent = ($depth) ? str_repeat ( "\t", $depth ) : '';
		
		$li_attributes = '';
		$class_names = $value = '';
		
		$classes = empty ( $item->classes ) ? array () : ( array ) $item->classes;
		
		// managing divider: add divider class to an element to get a divider
		// before it.
		$divider_class_position = array_search ( 'divider', $classes );
		if ($divider_class_position !== false) {
			$output .= "<li class=\"divider\"></li>\n";
			unset ( $classes [$divider_class_position] );
		}
		
		$classes [] = ($args->has_children) ? 'dropdown' : '';
		$classes [] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$classes [] = 'menu-item-' . $item->ID;
		if ($depth && $args->has_children) {
			$classes [] = 'dropdown-submenu';
		}
		
		$class_names = join ( ' ', apply_filters ( 'nav_menu_css_class', array_filter ( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr ( $class_names ) . '"';
		
		$id = apply_filters ( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = strlen ( $id ) ? ' id="' . esc_attr ( $id ) . '"' : '';
		
		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
		
		$attributes = ! empty ( $item->attr_title ) ? ' title="' . esc_attr ( $item->attr_title ) . '"' : '';
		$attributes .= ! empty ( $item->target ) ? ' target="' . esc_attr ( $item->target ) . '"' : '';
		$attributes .= ! empty ( $item->xfn ) ? ' rel="' . esc_attr ( $item->xfn ) . '"' : '';
		$attributes .= ! empty ( $item->url ) ? ' href="' . esc_attr ( $item->url ) . '"' : '';
		$attributes .= ($args->has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';
		
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters ( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($depth == 0 && $args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		// v($element);
		if (! $element)
			return;
			
			// $start="<li class=\"active\"><a href=\"index.html\"><i
			// class=\"icon-home\"></i></a></li>";
			// $start.= $output;
			// $output = $start;
		
		$id_field = $this->db_fields ['id'];
		
		// display this element
		if (is_array ( $args [0] ))
			$args [0] ['has_children'] = ! empty ( $children_elements [$element->$id_field] );
		else if (is_object ( $args [0] ))
			$args [0]->has_children = ! empty ( $children_elements [$element->$id_field] );
		$cb_args = array_merge ( array (
				&$output,
				$element,
				$depth 
		), $args );
		call_user_func_array ( array (
				&$this,
				'start_el' 
		), $cb_args );
		$id = $element->$id_field;
		
		// descend only when the depth is right and there are childrens for this
		// element
		if (($max_depth == 0 || $max_depth > $depth + 1) && isset ( $children_elements [$id] )) {
			
			foreach ( $children_elements [$id] as $child ) {
				
				if (! isset ( $newlevel )) {
					$newlevel = true;
					// start the child delimiter
					$cb_args = array_merge ( array (
							&$output,
							$depth 
					), $args );
					call_user_func_array ( array (
							&$this,
							'start_lvl' 
					), $cb_args );
				}
				$this->display_element ( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset ( $children_elements [$id] );
		}
		
		if (isset ( $newlevel ) && $newlevel) {
			// end the child delimiter
			$cb_args = array_merge ( array (
					&$output,
					$depth 
			), $args );
			call_user_func_array ( array (
					&$this,
					'end_lvl' 
			), $cb_args );
		}
		
		// end this element
		$cb_args = array_merge ( array (
				&$output,
				$element,
				$depth 
		), $args );
		call_user_func_array ( array (
				&$this,
				'end_el' 
		), $cb_args );
	}
}
/*
 * | ----------------------------------------------------------------- 
 * |  Get time stamp
 * | -----------------------------------------------------------------
 */
function time_stamp($time_ago) {
	$cur_time = time ();
	$time_elapsed = $cur_time - $time_ago;
	$seconds = $time_elapsed;
	$minutes = round ( $time_elapsed / 60 );
	$hours = round ( $time_elapsed / 3600 );
	$days = round ( $time_elapsed / 86400 );
	$weeks = round ( $time_elapsed / 604800 );
	$months = round ( $time_elapsed / 2600640 );
	$years = round ( $time_elapsed / 31207680 );
	// Seconds
	if ($seconds <= 60) {
		echo " Cách đây $seconds giây ";
	} 	// Minutes
	else if ($minutes <= 60) {
		if ($minutes == 1) {
			echo " Cách đây 1 phút ";
		} else {
			echo " Cách đây $minutes phút";
		}
	} 	// Hours
	else if ($hours <= 24) {
		if ($hours == 1) {
			echo "Cách đây 1 tiếng ";
		} else {
			echo " Cách đây  $hours tiếng ";
		}
	} 	// Days
	else if ($days <= 7) {
		if ($days == 1) {
			echo " Ngày hôm qua ";
		} else {
			echo " Cách đây  $days ngày ";
		}
	} 	// Weeks
	else if ($weeks <= 4.3) {
		if ($weeks == 1) {
			echo " Cách đây 1 tuần ";
		} else {
			echo " Cách đây  $weeks tuần";
		}
	} 	// Months
	else if ($months <= 12) {
		if ($months == 1) {
			echo " Cách đây 1 tháng ";
		} else {
			echo " Cách đây $months tháng";
		}
	} 	// Years
	else {
		if ($years == 1) {
			echo " Cách đây 1 năm ";
		} else {
			echo " Cách đây $years năm ";
		}
	}
}
//end time_stamp
/*
 * | ----------------------------------------------------------------- 
 * |  Get n character 
 * | -----------------------------------------------------------------
 */
function _substr($str, $n, $link) {
	if (strlen ( $str ) < $n)
		return $str;
	$html = substr ( $str, 0, $n );
	$html = substr ( $html, 0, strrpos ( $html, ' ' ) );
	return $html.'...';//. $link1;
}
/*
 * | ----------------------------------------------------------------- 
 * |  Get first image in post
 * | -----------------------------------------------------------------
 */
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];

  if(empty($first_img)) {
    $first_img = bloginfo('template_url')."/images/main-bar-gradient.png";
  }
  return $first_img;
}
/*
 * | ----------------------------------------------------------------- 
 * |  Pagination
 * | -----------------------------------------------------------------
 */
function iz_pagination($pages = '', $range = 5) {
	$showitems = ($range * 2) + 1;
	
	global $paged;
	if (empty ( $paged ))
		$paged = 1;
	
	if ($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if (! $pages) {
			$pages = 1;
		}
	}
	
	if (1 != $pages) {
		echo "<div class='pagination pagination-centered'><ul>";
		if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
			echo "<li><a href='" . get_pagenum_link ( 1 ) . "'>&laquo;</a></li>";
		if ($paged > 1 && $showitems < $pages)
			echo "<li><a href='" . get_pagenum_link ( $paged - 1 ) . "'>&lsaquo;</a></li>";
		
		for($i = 1; $i <= $pages; $i ++) {
			if (1 != $pages && (! ($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
				echo ($paged == $i) ? "<li class='active'><span class='current'>" . $i . "</span></li>" : "<li><a href='" . get_pagenum_link ( $i ) . "' class='inactive' >" . $i . "</a></li>";
			}
		}
		
		if ($paged < $pages && $showitems < $pages)
			echo "<li><a href='" . get_pagenum_link ( $paged + 1 ) . "'>&rsaquo;</a></li>";
		if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
			echo "<li><a href='" . get_pagenum_link ( $pages ) . "'>&raquo;</a></li>";
		echo "</ul></div>\n";
	}
}