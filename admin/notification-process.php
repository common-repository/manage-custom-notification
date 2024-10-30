<?php
defined('ABSPATH') or die("restricted access");
function mcn_insert_data_process()
{
	global $wpdb;
	if(isset($_POST['title'])&& $_POST['title']!="")
	{		
		$title=sanitize_text_field($_POST['title']);
		$content=esc_textarea($_POST['content']);
		$link_check=!empty($_POST['link_check']) ? intval($_POST['link_check']) : 0;
		$link=esc_url($_POST['link']);
		$blink_check=sanitize_text_field($_POST['blink_check']);
		$target_check=sanitize_text_field($_POST['target_check']);
		$cat_id=intval($_POST['cat_id']);
		$data=array(
					'title'			=> $title,
					'content'		=> $content,
					'link_check'	=> $link_check,
					'link' 			=> $link,
					'cat_id' 		=> $cat_id,
					'blink_check'	=> $blink_check,
					'target_check'  => $target_check
					);
		$wpdb->insert( 'wp_mcn_notification', $data);	
		wp_redirect( admin_url('admin.php?page=notification-list&in_msg=suc') );		
		exit();	
	}
}
function mcn_edit_data_process()
{
	global $wpdb;
	if(isset($_POST['title']) && $_POST['title']!="")
	{		
		$id=intval($_POST['edit_notification_id']);
		$title=sanitize_text_field($_POST['title']);
		$content=esc_textarea($_POST['content']);
		$link_check=!empty($_POST['link_check']) ? intval($_POST['link_check']) : 0;
		$link=esc_url($_POST['link']);
		$blink_check=sanitize_text_field($_POST['blink_check']);
		$target_check=sanitize_text_field($_POST['target_check']);
		$cat_id=intval($_POST['cat_id']);
		$data=array(
					'title'			=> $title,
					'content'		=> $content,
					'link_check'	=> $link_check,
					'link' 			=> $link,
					'cat_id' 		=> $cat_id,
					'blink_check'	=> $blink_check,
					'target_check'  => $target_check
					);
		$where = array('id' => $id);
		$wpdb->update( 'wp_mcn_notification', $data, $where);	
		wp_redirect( admin_url('admin.php?page=notification-list&ed_msg=suc') );		
		exit();	
	}
}
function mcn_delete_data_process()
{
	global $wpdb;
	if(isset($_POST['notification_id']) && $_POST['notification_id']!="" && (isset($_POST['select_action_top']) && $_POST['select_action_top']=="delete" || isset($_POST['select_action_bottom']) && $_POST['select_action_bottom']=="delete"))
	{	
		$id_array=explode(",",sanitize_text_field($_POST['notification_id']));
		foreach($id_array as $id)
		{
			$where = array('id' => $id);
			$wpdb->delete('wp_mcn_notification',$where);
		}
		wp_redirect(admin_url('admin.php?page=notification-list&dl_msg=suc'));
	}
	else
	{
		wp_redirect(admin_url('admin.php?page=notification-list'));		
	}
	exit();
}