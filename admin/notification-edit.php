<?php
defined('ABSPATH') or die("restricted access");
function mcn_edit_data()
{
global $current_user;
if(!mcn_check_current_user_level())
{
	wp_die( __('<h2>You do not have enough permissions to access this page.</h2>') );
}
?>
	<div class="wrap">
        <h1>Edit notification <a href="<?php echo admin_url('admin.php?page=notification-list'); ?>" class="page-title-action" role="button">Notifications</a></h1>
        <form name="edit_form" method="post" action="<?php echo get_admin_url().'admin-post.php'; ?>" onsubmit="return insert_form_valid_check()" novalidate>    
			<?php wp_nonce_field( 'cn_ed_verify' ); ?> 
			<?php 
			if(isset($_GET['notification_id'])&& $_GET['notification_id']!="")
			{
				$notification_id=$_GET['notification_id'];
				global $wpdb;
				$results_array = $wpdb->get_results( "SELECT * FROM wp_mcn_notification WHERE id=$notification_id");
				$edit_cat_id="";
				foreach ($results_array as $key => $object_edit) 
				{					
					$edit_cat_id=$object_edit->cat_id;
					$link_check=$object_edit->link_check;
					if($link_check==1)
					{
						$check="checked";
						$style="style='display:block;'";
					}
					else
					{
						$style="style='display:none;'";
					}
					if($object_edit->blink_check=='on')
					{
						$blink_check="checked";
					}
					if($object_edit->target_check=='on')
					{
						$target_check="checked";
					}
				}
			?>
			<input type="hidden" name="action" value="submit-edit-form-data" />  
			<input type="hidden" name="edit_notification_id" value="<?php echo !empty($notification_id) ? $notification_id : ''; ?>" />
			 <p>
				<label class="input_label" id="" for="title">Select Category : </label><br>
				<select name="cat_id" id="cat_id" class="input_box own_input" style="">
					<?php 
					global $wpdb;
					$results = $wpdb->get_results( "SELECT * FROM wp_mcn_notification_category");
					foreach ($results as $key => $object_select) 
					{  
						if($object_select->id==$edit_cat_id)
						{
							$select="selected";
						}
						else
						{
							$select="";
						}
					?>
					<option value="<?php echo $object_select->id; ?>" <?php echo $select; ?>><?php echo $object_select->cat_name; ?></option>
					<?php } ?>		
				</select>
			</p>   				
			<p>
				<label class="input_label" for="title">Title</label><br>
				<input type="text"  name="title" id="title" class="input_box own_input" size="30" value="<?php echo !empty($object_edit->title) ? $object_edit->title : '' ; ?>" spellcheck="true" required/>
			</p>        				
			<p>
				<label class="input_label" id="" for="title">Display Content</label><br>
				<textarea name="content" rows="4" id="content" cols="33" class="own_input" required><?php echo !empty($object_edit->content) ? $object_edit->content : ''; ?></textarea>
			</p>
			<p>
				<input type="checkbox" name="link_check" id="link_check" onclick="link_che()"  value="<?php echo !empty($object_edit->link_check) ? $object_edit->link_check : ''; ?>" <?php echo $check; ?>>Check to enable <b>notification content</b> as a link.
			</p>
			<div id="link_p" <?php echo $style; ?>>
				<p>
				<input type="text"  name="link" id="link" class="input_box own_input" value="<?php echo !empty($object_edit->link) ? $object_edit->link : '' ; ?>" placeholder="Enter link" size="30" spellcheck="true" required/><br>
				<span>Please give full link of the website</span>
				</p>
				<p>
					<input type="checkbox"  name="target_check" id="target_check" <?php echo $target_check; ?>/>Check to enable link <b>open in new window.</b>
				</p>
			</div>
			<p>
				<input type="checkbox" name="blink_check" id="blink_check" <?php echo $blink_check; ?>>Check to enable <b>Blink property</b> on your notification category.
			</p>
			<input type="submit"class="button button-primary button-large" name="Submit" value="Update Notification" />					
			<?php  }?>	
        </form>
    </div>
<?php } ?>