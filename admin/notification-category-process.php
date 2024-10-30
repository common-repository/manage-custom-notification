<?php
defined('ABSPATH') or die("restricted access");
function mcn_cat_insert_data_process()
{
	global $wpdb;
	if(isset($_POST['cat_name'])&& $_POST['cat_name']!="")
	{		
		$cat_name=sanitize_text_field($_POST['cat_name']);
		$marquee_direction=sanitize_text_field($_POST['direction']);
		$marquee_width=sanitize_text_field($_POST['marquee_width']);
		$marquee_height=sanitize_text_field($_POST['marquee_height']);
		$marquee_scrolldelay=sanitize_text_field($_POST['marquee_scrolldelay']);
		$marquee_check=!empty($_POST['marquee_check']) ? intval($_POST['marquee_check']) : 0;
		$data=array(
					'cat_name'          	=> $cat_name,
					'marquee_direction' 	=> $marquee_direction,
					'marquee_check' 		=> $marquee_check,
					'marquee_width' 		=> $marquee_width,
					'marquee_height' 		=> $marquee_height,
					'marquee_scrolldelay'	=> $marquee_scrolldelay
					);
		$wpdb->insert( 'wp_mcn_notification_category', $data);	
		wp_redirect( admin_url('admin.php?page=category-list&in_msg=suc') );		
		exit();	
	}
}
 function mcn_cat_edit_data_process()
{
	global $wpdb;
	if(isset($_POST['cat_name'])&& $_POST['cat_name']!="")
	{		
		$id=intval($_POST['edit_category_id']);
		$cat_name=sanitize_text_field($_POST['cat_name']);
		$marquee_check=!empty($_POST['marquee_check']) ? intval($_POST['marquee_check']) : 0;
		$marquee_direction=sanitize_text_field($_POST['direction']);
		$marquee_width=sanitize_text_field($_POST['marquee_width']);
		$marquee_height=sanitize_text_field($_POST['marquee_height']);
		$marquee_scrolldelay=sanitize_text_field($_POST['marquee_scrolldelay']);
		$data=array(
					'cat_name'          	=> $cat_name,
					'marquee_direction' 	=> $marquee_direction,
					'marquee_check' 		=> $marquee_check,
					'marquee_width' 		=> $marquee_width,
					'marquee_height' 		=> $marquee_height,
					'marquee_scrolldelay'	=> $marquee_scrolldelay
					);
		$where = array('id' => $id);
		$wpdb->update( 'wp_mcn_notification_category', $data, $where);	
		wp_redirect( admin_url('admin.php?page=category-list&ed_msg=suc') );		
		exit();	
	}
}
function mcn_cat_delete_data_process()
{
	global $wpdb;
	if(isset($_POST['category_id']) && $_POST['category_id']!="")
	{
		if((isset($_POST['select_action_top']) && $_POST['select_action_top']=="delete") || (isset($_POST['select_action_bottom']) && $_POST['select_action_bottom']=="delete"))
		{
			$id_array=explode(",",sanitize_text_field($_POST['category_id']));
			foreach($id_array as $id)
			{
				$where = array('id' => $id);
				$where_n = array('cat_id' => $id);
				$wpdb->delete('wp_mcn_notification',$where_n);
				$wpdb->delete('wp_mcn_notification_category',$where);
				
			}
			wp_redirect(admin_url('admin.php?page=category-list&dl_msg=suc'));					
		}
		else
		{
			wp_redirect(admin_url('admin.php?page=category-list'));		
		}
	}
	else
	{
		wp_redirect(admin_url('admin.php?page=category-list'));		
	}	
	exit();
} 