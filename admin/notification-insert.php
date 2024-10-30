<?php
defined('ABSPATH') or die("restricted access");
function mcn_insert_data()
{
	global $current_user;
if(!mcn_check_current_user_level())
	{
		wp_die( __('<h2>You do not have enough permissions to access this page.</h2>') );
	}
?>
	<div class="wrap">
        <h1>Add New Notification <a href="<?php echo admin_url('admin.php?page=notification-list'); ?>" class="page-title-action" role="button">Notification</a></h1>
        <p>If you have any type of query releted to Alert customization then please contact with query to <b>rupamhazra@gmail.com</b></p>
        <form name="insert_form" method="post" action="<?php echo get_admin_url().'admin-post.php'; ?>" onsubmit="return insert_form_valid_check()" novalidate>    
			<?php wp_nonce_field( 'cn_in_verify' ); ?>
            <input type="hidden" name="action" value="submit-insert-form-data" />  
            <p>
				<label class="input_label" id="" for="title">Select Category : </label><br>
				<select name="cat_id" id="cat_id" class="input_box own_input">
					<?php 
					global $wpdb;
					$results = $wpdb->get_results( "SELECT * FROM wp_mcn_notification_category");
					foreach ($results as $key => $object) 
					{  
					?>
					<option value="<?php echo $object->id; ?>"><?php echo $object->cat_name; ?></option>
					<?php } ?>		
				</select>
			</p>   			
			<p>
				<label class="input_label" for="title">Title</label><br>
				<input type="text"  name="title" id="title" class="input_box own_input" size="29" spellcheck="true"/>
			</p>
			     				
			<p>
				<label class="input_label" id="" for="title">Display Content</label><br>
				<textarea name="content" id="content" rows="4" cols="33" class="own_input" ></textarea>
			</p>

			<p>
				<input type="checkbox" name="link_check" id="link_check" onclick="link_che()"  value="0">Check to enable <b>notification content</b> as a link.
			</p>
			<div id="link_p" style="display:none;">
				<p>
					<input type="text"  name="link" id="link" class="input_box own_input" value="" placeholder="Enter link" size="30" spellcheck="true" required/><br>
					<span>Please give full link of the website</span>

				</p>
				<p>
					<input type="checkbox"  name="target_check" id="target_check" />Check to enable link <b>open in new window.</b>
				</p>
			</div>
			<p>
				<input type="checkbox" name="blink_check" id="blink_check">Check to enable <b>Blink property</b> on your notification.
			</p>
			<input type="submit"class="button button-primary button-large" name="Submit" value="Save Notification" />	
			<p><b>If this plugin is usefull for you then please rate it.</b></p>			
        </form>
    </div>
<?php } ?>