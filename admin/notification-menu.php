<?php
defined('ABSPATH') or die("restricted access");
function add_notification_options()  
{  
	$authorized_level = 'level_0';
    add_menu_page('Manage Custom Notification', 'Manage Custom Notification', $authorized_level, 'category-list','','dashicons-flag');  
    add_submenu_page('category-list', 'Categories','Categories',$authorized_level, 'category-list','mcn_notification_category'); 
	add_submenu_page('category-list', 'All Notifications','All Notifications',$authorized_level, 'notification-list','mcn_notification_main'); 
	add_submenu_page('category-list', 'Add New','Add New',$authorized_level, 'notification-insert','mcn_insert_data');
	
}