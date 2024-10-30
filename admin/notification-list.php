<?php
defined('ABSPATH') or die("restricted access");
function mcn_notification_list()
{
	global $wpdb;
	$results = $wpdb->get_results( "SELECT cnn.id as not_id,cat_id,title,content,link,cat_name,marquee_direction FROM wp_mcn_notification AS cnn LEFT JOIN wp_mcn_notification_category AS cnc ON cnn.cat_id=cnc.id");
?>
	<div class="wrap">
		<h1>Custom Notifications <a href="<?php echo admin_url('admin.php?page=notification-list&view=addnew'); ?>" class="page-title-action" role="button">Add New</a></h1>
		<?php include_once('notification-message.php');?>
		<form method="post" name="delete_form" id="deleteForm" action="<?php echo get_admin_url().'admin-post.php'; ?>">
			<input type="hidden" name="action" value="submit-delete-form-data" />  
			<input type="hidden" id="notification_id" name="notification_id" value=""/> 
			<div class="tablenav top" id="tablenavtop_id">
				<div class="alignleft actions bulkactions">
					<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
					<select name="select_action_top" id="bulk-action-selector-top">
						<option value="-1">Bulk Actions</option>
						<option value="delete" class="hide-if-no-js">Delete</option>
					</select>
					<input type="button" id="doaction" class="button action"  onclick="how_many();" value="Apply">
				</div>
				<div class="tablenav-pages one-page"><span class="displaying-num" id="total_item_top_id"></span></div>
			</div>
			<table class="wp-list-table widefat fixed striped posts">
				<thead>
				  <tr>
					<th>
						<input id="root_checkbox_id_top" type="checkbox"  style="margin-left:0px;margin-right:5px;" value="1" onclick="all_check_top()">
						<span>Title</span>
					</th>
					<th>Category</th>
					<th>Link</th>
					<th>Content</th>
					<th>Shortcode</th>
				  </tr>
				</thead>
				
				<tbody id="the-list">					  
						<?php	
						$count_item=0;
						foreach ($results as $key => $object) {  
							$noti_id     = !empty($object->not_id) ? $object->not_id : '';
							$noti_title  = !empty($object->title)? $object->title : '';
							$cat_name  = !empty($object->title)? $object->cat_name : '';
							$noti_content= !empty($object->content)? $object->content : '';
							$noti_link= !empty($object->link)? $object->link : '';
							$noti_cat_marquee_direction= !empty($object->marquee_direction)? $object->marquee_direction : '';
							$count_item++;
						?>								
						<tr>
							<td>
								<input id="delete_check_id_<?php echo $noti_id; ?>" class="delete_check_class" type="checkbox" name="delete_check[]" onclick="each_check(<?php echo $noti_id; ?>)" value="<?php echo $noti_id; ?>">								
							<a href="<?php echo admin_url('admin.php?page=notification-list&view=edit&notification_id='.$noti_id); ?>"><?php echo $noti_title; ?></a></td>
							<td><a href="<?php echo admin_url('admin.php?page=notification-list&view=edit&notification_id='.$noti_id); ?>"><?php echo $cat_name; ?></a></td>
							<td><a href="<?php echo admin_url('admin.php?page=notification-list&view=edit&notification_id='.$noti_id); ?>"><?php echo $noti_link; ?></a></td>
							<td><a href="<?php echo admin_url('admin.php?page=notification-list&view=edit&notification_id='.$noti_id); ?>"><?php echo $noti_content; ?></a></td>
							<td><strong>[mcn_notification id="<?php echo $noti_id; ?>"]</strong>
								<br>
								<span>Shortcode for .php file <br> <?php $str='<?php do_shortcode("[mcn_notification id="'.$noti_id.'")" ?>'; echo highlight_string($str,TRUE) ?></span>
							</td>
						</tr>
						<?php	} if($count_item==0){?>
						<tr><td colspan="5">No notification found</td></tr>	
						<?php } ?>
				</tbody>
				</div>
				<tfoot>
				  <tr>
					<th>
						<input id="root_checkbox_id_bottom" type="checkbox" style="margin-left:0px;margin-right:5px;" value="1" onclick="all_check_bottom()">
						<span>Title</span>
					</th>
					<th>Category</th>
					<th>Link</th>
					<th>Content</th>
					<th>Shortcode</th>	
				  </tr>
				</tfoot>
			</table>
			<div class="tablenav bottom" id="tablenavbottom_id">
				<div class="alignleft actions bulkactions">
					<label for="bulk-action-selector-bottom" class="screen-reader-text">Select bulk action</label><select name="select_action_bottom" id="bulk-action-selector-bottom">
							<option value="-1">Bulk Actions</option>
							<option value="delete" class="hide-if-no-js">Delete</option>
						</select>
					<input type="submit" id="doaction2" class="button action" onclick="how_many();" value="Apply">
				</div>
				<div class="tablenav-pages one-page"><span class="displaying-num" id="total_item_bottom_id"></span></div>
				<br class="clear">
			</div>
			<script> 
				var count_item = <?php echo $count_item; ?>;
				if(count_item == 0)
				{
					document.getElementById('tablenavbottom_id').style.display="none";
					document.getElementById('tablenavtop_id').style.display="none";
				}
				document.getElementById('total_item_top_id').innerHTML=count_item +" item";
				document.getElementById('total_item_bottom_id').innerHTML=count_item +" item";
			</script>
		</form>	
	</div>	
<?php } ?>