<?php
defined('ABSPATH') or die("restricted access");
function mcn_category_list()
{
	global $wpdb;
	$results = $wpdb->get_results( "SELECT * FROM wp_mcn_notification_category");
?>
	<div class="wrap">
		<h1>Notifications Categories <a href="<?php echo admin_url('admin.php?page=category-list&view=addnew'); ?>" class="page-title-action" role="button">Add New</a></h1>
		<?php include_once('notification-category-message.php');?>
		<form method="post" name="delete_cat_form" id="delete_cat_form" action="<?php echo get_admin_url().'admin-post.php'; ?>">
			<input type="hidden" name="action" value="submit-cat-delete-form-data" />  
			<input type="hidden" id="category_id" name="category_id" value=""/> 
			<div class="tablenav top" id="tablenavtop_id">
				<div class="alignleft actions bulkactions">
					<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
					<select name="select_action_top" id="bulk-action-selector-top">
						<option value="-1">Bulk Actions</option>
						<option value="delete" class="hide-if-no-js">Delete</option>
					</select>
					<input type="button" id="doaction" class="button action"  onclick="how_many_cat();" value="Apply">
				</div>
				<div class="tablenav-pages one-page"><span class="displaying-num" id="total_item_top_id"></span></div>
			</div>
			<table class="wp-list-table widefat fixed striped posts">
				<thead>
				  <tr>
					<th colspan="2" style="width: 38%;">
						<input id="root_checkbox_id_top" type="checkbox"  style="margin-left:0px;margin-right:5px;" value="1" onclick="all_check_top_cat()">
						<span>Title</span>
					</th>
					<th>Marquee Direction</th>
					<th>Shortcode</th>
				  </tr>
				</thead>
				
				<tbody id="the-list">					  
						<?php	
						$count_item=0;
						foreach ($results as $key => $object) {  
							$noti_cat_id     = !empty($object->id) ? $object->id : '';
							$noti_cat_title  = !empty($object->cat_name)? $object->cat_name : '';
							$noti_cat_marquee_direction= !empty($object->marquee_direction)? $object->marquee_direction : '';
							$count_item++;
						?>								
						<tr>
							<td colspan="2">
								<input id="delete_check_id_<?php echo $noti_cat_id; ?>" class="delete_check_class" type="checkbox" name="delete_check[]" onclick="each_check_cat(<?php echo $noti_cat_id; ?>)" value="<?php echo $noti_cat_id; ?>">
								
							<a href="<?php echo admin_url('admin.php?page=category-list&view=edit&category_id='.$noti_cat_id); ?>"><?php echo $noti_cat_title; ?></a></td>
							<td><a href="<?php echo admin_url('admin.php?page=category-list&view=edit&category_id='.$noti_cat_id); ?>"><?php echo $noti_cat_marquee_direction; ?></a></td>
							<td><strong>[mcn_notification catid="<?php echo $noti_cat_id; ?>"]</strong><br>
								<span>Shortcode for .php file <br> <?php $str='<?php do_shortcode("[mcn_notification catid="'.$noti_cat_id.'"]") ?>'; echo highlight_string($str,TRUE) ?></span>
							</td>
						</tr>
						<?php	} if($count_item==0){?>
						<tr><td colspan="4">No <b>notification category</b> found</td></tr>	
						<?php } ?>
				</tbody>
				</div>
				<tfoot>
				  <tr>
					<th colspan="2">
						<input id="root_checkbox_id_bottom" type="checkbox" style="margin-left:0px;margin-right:5px;" value="1" onclick="all_check_bottom_cat()">
						<span>Title</span>
					</th>
					<th>Marquee Direction</th>
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
					<input type="submit" id="doaction2" class="button action" onclick="how_many_cat();" value="Apply">
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