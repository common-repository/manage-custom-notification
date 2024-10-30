<?php
/*
Plugin Name: Manage Custom Notification
Author: Rupam Hazra
Description: This pluin is used to Manage Custom Notification on your site.
Version:1.0
*/
defined('ABSPATH') or die("restricted access");
if(is_admin())
{
	include_once(dirname(__FILE__).'/admin/notification-menu.php');
	include_once(dirname(__FILE__).'/admin/notification-list.php');
	include_once(dirname(__FILE__).'/admin/notification-insert.php');
	include_once(dirname(__FILE__).'/admin/notification-process.php');
	include_once(dirname(__FILE__).'/admin/notification-edit.php');
	include_once(dirname(__FILE__).'/admin/notification-category-list.php');
	include_once(dirname(__FILE__).'/admin/notification-category-insert.php');
	include_once(dirname(__FILE__).'/admin/notification-category-process.php');
	include_once(dirname(__FILE__).'/admin/notification-category-edit.php');
	add_action( 'admin_enqueue_scripts', 'cn_notification_scripts_css' );	
}
else
{
	add_action( 'wp_enqueue_scripts', 'cn_notification_scripts_css');			
}
function cn_notification_scripts_css()
{	
	if( is_admin() )
	{
		wp_enqueue_style('notification-admin-styles', plugins_url( 'admin/css/notification-admin-styles.css', __FILE__ ) );
		wp_enqueue_script('notification-script', plugins_url( 'admin/js/notification-script.js', __FILE__ ) );
		wp_enqueue_script('notification-category-script', plugins_url( 'admin/js/notification-category-script.js', __FILE__ ) );
	}
	else
	{
		wp_enqueue_style('notification-front-styles', plugins_url( 'admin/css/notification-front-styles.css', __FILE__ ) );
	}
} 	
function mcn_notification ($atts) 
{
	$a = shortcode_atts(array(
							'id' => null,
							'catid'   => null, 
							),$atts );
	mcn_query_select_notification($a['id'],$a['catid']);	
}
function mcn_query_select_notification($id='',$catid='')
{
	global $wpdb;
	if($id!='')
	{	
		$id_array=explode(",", $id);			
		$start_tag="<div class='alert_blink' id='mcn_main_div_id'>";
		$end_tag="</div>";
		echo $start_tag;
		foreach($id_array as $id)
		{
			$result=$wpdb->get_results("SELECT * FROM wp_mcn_notification AS cnn LEFT JOIN wp_mcn_notification_category AS cnc ON cnn.cat_id=cnc.id WHERE cnn.id=$id");	
			foreach ($result as $key=> $object) 
			{   
				if($object->blink_check=="on")
				{
					$blink_check="blink_me";
				}
				if($object->target_check=="on")
				{
					$target_check="_blank";
				}
				$marquee_width=$object->marquee_width;
				$marquee_height=$object->marquee_height;
				$marquee_scrolldelay=$object->marquee_scrolldelay;
				$marquee_direction=$object->marquee_direction;	
				if($object->link!="" || $object->link!=null)
				{
					 $html.= "<p class='".$blink_check."'><a href='".$object->link."' style='cursor: pointer;' target='".$target_check."'>'".$object->content."'</a><p>";
				}
				else
				{
					 $html.= "<p class='".$blink_check."'>".$object->content."</p>";
				}
			?>
			<script type="text/javascript">
				window.onload=function(){
					var marquee_direction="<?php echo $marquee_direction; ?>";
					if(marquee_direction!='inactive')
					{
						var element = document.createElement("marquee");
						element.id="marquee_id";
						element.innerHTML="<?php echo $html; ?>";
    					document.getElementById('mcn_main_div_id').appendChild(element);	
					}
					else
					{
						document.getElementById('mcn_main_div_id').innerHTML="<?php echo $html; ?>";			
					}
					document.getElementById('marquee_id').style.width = "<?php echo $marquee_width; ?>";
					document.getElementById('marquee_id').style.height= "<?php echo $marquee_height; ?>";
					document.getElementById('marquee_id').scrollDelay= "<?php echo $marquee_scrolldelay; ?>";
					document.getElementById('marquee_id').direction= marquee_direction;
				};
			</script>
			<?php	
			}
		}
		echo $end_tag;
	}
	if($catid!='')
	{

		$catid_array=explode(",", $catid);
		$start_tag="<div class='alert_blink' id='mcn_main_cat_div_id'>";
		$end_tag="</div>";
		echo $start_tag;
		foreach($catid_array as $catid)
		{

			$result=$wpdb->get_results("SELECT * FROM wp_mcn_notification AS cnn LEFT JOIN wp_mcn_notification_category AS cnc ON cnn.cat_id=cnc.id WHERE cnc.id=$catid");	
			foreach ($result as $key=> $object) 
			{   
				$marquee_width_cat=$object->marquee_width;
				$marquee_height_cat=$object->marquee_height;
				$marquee_scrolldelay_cat=$object->marquee_scrolldelay;
				$marquee_cat_direction=$object->marquee_direction;	
				
				if($object->blink_check=="on")
				{
					$blink_check="blink_me";
				}
				if($object->target_check=="on")
				{
					$target_check="_blank";
				}		
				if($object->link!="" || $object->link!=null)
				{
					 $html.= "<p class='".$blink_check."'><a href=".$object->link." style='cursor: pointer;' target='".$target_check."'>".$object->content."</a><p>";
				}
				else
				{
					$html.= "<p class='".$blink_check."'>".$object->content."</p>";
				}
			?>
				<script type="text/javascript">
				window.onload=function(){
					var marquee_cat_direction="<?php echo $marquee_cat_direction; ?>";
					if(marquee_cat_direction!='inactive')
					{
						var element = document.createElement("marquee");
						element.id="marquee_id_cat";
						element.innerHTML="<?php echo $html; ?>";
    					document.getElementById('mcn_main_cat_div_id').appendChild(element);	
					}
					else
					{
						document.getElementById('mcn_main_cat_div_id').innerHTML="<?php echo $html; ?>";			
					}
					document.getElementById('marquee_id_cat').style.width = "<?php echo $marquee_width_cat; ?>";
					document.getElementById('marquee_id_cat').style.height= "<?php echo $marquee_height_cat; ?>";
					document.getElementById('marquee_id_cat').scrollDelay= "<?php echo $marquee_scrolldelay_cat; ?>";
					document.getElementById('marquee_id_cat').direction= marquee_cat_direction;
				};
			</script>

			<?php	
			}
		}
		echo $end_tag;
	}	
}
function mcn_check_current_user_level()
{
	global $current_user;
	if ( current_user_can('level_3') )
	{
			return true;
	}
}
function mcn_notification_main()
{
	global $current_user;
	$mcn_notification_curr_view='list';
	if(isset($_GET['view']) && $_GET['view'])
	{
		$mcn_notification_curr_view = trim($_GET['view']);
	}
	if(isset($_POST['view']) && $_POST['view'])
	{
		$mcn_notification_curr_view = trim($_POST['view']);
	}
	if (!empty($mcn_notification_curr_view) && $mcn_notification_curr_view == 'list')
	{
		mcn_notification_list(); // listing the alerts
	}
	else if(!empty($mcn_notification_curr_view)  && $mcn_notification_curr_view == 'addnew')
	{
		if(!mcn_check_current_user_level())
		{
			wp_die( __('<h2>You do not have enough permissions to access this page.</h2>') );
		}	
		mcn_insert_data();	// calling insert form	
	}
	else if(!empty($mcn_notification_curr_view) &&  $mcn_notification_curr_view == 'edit')
	{
		if(!mcn_check_current_user_level())
		{
			wp_die( __('<h2>You do not have enough permissions to access this page.</h2>') );
		}	
		mcn_edit_data();	// calling edit form	
	}
}
function mcn_notification_category()
{
	$mcn_notification_curr_view='list';
	if(isset($_GET['view']) && $_GET['view'])
	{
		$mcn_notification_curr_view = trim($_GET['view']);
	}
	if(isset($_POST['view']) && $_POST['view'])
	{
		$mcn_notification_curr_view = trim($_POST['view']);
	}
	if (!empty($mcn_notification_curr_view) && $mcn_notification_curr_view == 'list')
	{
		mcn_category_list(); // listing the category
	}
	else if(!empty($mcn_notification_curr_view)  && $mcn_notification_curr_view == 'addnew')
	{
		if(!mcn_check_current_user_level())
		{
			wp_die( __('<h2>You do not have enough permissions to access this page.</h2>') );
		}
		mcn_category_insert_data();	// calling category insert form	
	}
	else if(!empty($mcn_notification_curr_view) &&  $mcn_notification_curr_view == 'edit')
	{
		if(!mcn_check_current_user_level())
		{
			wp_die( __('<h2>You do not have enough permissions to access this page.</h2>') );
		}
		mcn_category_edit_data();	// calling category edit form	
	}
}
function mcn_notification_activate()
{
		//create or update table
		mcn_notification_create_table();		
		// Clear the permalinks
		flush_rewrite_rules();
}
function mcn_notification_deactivate()
{
		// Clear the permalinks
		flush_rewrite_rules();
}
function mcn_notification_uninstall()
{
		mcn_notification_remove_table();
}
function mcn_notification_create_table()
{
	global $wpdb;	
	require_once(ABSPATH . '/wp-admin/includes/upgrade.php');	
	if (!isset ($wpdb->charset))
	{
		$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
	}
	if (!isset ($wpdb->collate))
	{
		$charset_collate .= " COLLATE {$wpdb->collate}";
	}	
	$table_name = "wp_mcn_notification";
	$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `cat_id` int(11) NOT NULL,
				  `title` varchar(100) NOT NULL,
				  `content` text NOT NULL,
				  `link_check` tinyint(4) NOT NULL,
				  `link` varchar(100) NULL,
				  `blink_check` varchar(4) NULL,
				  `target_check` varchar(4) NULL,
				  PRIMARY KEY (`id`)
			) $charset_collate;";
	dbDelta($sql);
	$table_name = "wp_mcn_notification_category";
	$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `cat_name` varchar(100) NOT NULL,
				  `marquee_check` tinyint(4) NOT NULL,
				  `marquee_direction` varchar(30) NOT NULL,
				  `marquee_width` varchar(100) NULL,
				  `marquee_height` varchar(100) NULL,
				  `marquee_scrolldelay` varchar(100) NULL,
				  PRIMARY KEY (`id`)
			) $charset_collate;";		
	dbDelta($sql);
}
function mcn_notification_remove_table()
{
	global $wpdb;
	$table = $wpdb->prefix."mcn_notification";
	$table_c = $wpdb->prefix."mcn_notification_category";
	$wpdb->query("DROP TABLE IF EXISTS $table");
	$wpdb->query("DROP TABLE IF EXISTS $table_c");	
}
	register_activation_hook(__FILE__,'mcn_notification_activate' ); // resgister hook
	register_deactivation_hook( __FILE__,'mcn_notification_deactivate');
	register_uninstall_hook( __FILE__, 'mcn_notification_uninstall' ); // uninstall plugin
	add_shortcode( 'mcn_notification', 'mcn_notification' ); // add shortcode hook
	add_action('admin_menu', 'add_notification_options'); // add menu hook
	add_action( 'admin_post_submit-insert-form-data', 'mcn_insert_data_process' ); // insert action decleared
	add_action( 'admin_post_submit-edit-form-data', 'mcn_edit_data_process' ); // edit action decleared
	add_action( 'admin_post_submit-delete-form-data', 'mcn_delete_data_process' ); // delete action decleared
	add_action( 'admin_post_submit-cat-insert-form-data', 'mcn_cat_insert_data_process' ); // insert category action decleared
	add_action( 'admin_post_submit-cat-edit-form-data', 'mcn_cat_edit_data_process' ); // edit action decleared
	add_action( 'admin_post_submit-cat-delete-form-data', 'mcn_cat_delete_data_process' ); // delete action decleared