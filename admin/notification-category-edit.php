<?php
defined('ABSPATH') or die("restricted access");
function mcn_category_edit_data()
{
global $current_user;
if(!mcn_check_current_user_level())
{
	wp_die( __('<h2>You do not have enough permissions to access this page.</h2>') );
}
?>
	<div class="wrap">
        <h1>Edit Category <a href="<?php echo admin_url('admin.php?page=category-list'); ?>" class="page-title-action" role="button">Notification Category</a></h1>
        <form name="cat_edit_form" method="post" action="<?php echo get_admin_url().'admin-post.php'; ?>" onsubmit="return cat_insert_form_valid_check()" novalidate>    
			<?php wp_nonce_field( 'cn_cat_ed_verify' ); ?> 
			<?php 
			if(isset($_GET['category_id'])&& $_GET['category_id']!="")
			{
				$category_id=$_GET['category_id'];
				global $wpdb;
				$results = $wpdb->get_results( "SELECT * FROM wp_mcn_notification_category WHERE id=$category_id");
				foreach ($results as $key => $object) 
				{	
					if($object->marquee_direction=='inactive')
					{
						$style_marquee_property="style=display:none;";
					}
					
					$marquee_check=$object->marquee_check;
					if($marquee_check==1)
					{
						$check="checked";
						$style="style='display:block;'";
					}
					else
					{
						$style="style='display:none;'";
					}
			?>
			<input type="hidden" name="action" value="submit-cat-edit-form-data" />  
			<input type="hidden" name="edit_category_id" value="<?php echo !empty($category_id) ? $category_id : ''; ?>" /> 			
			<p>
				<label class="input_label" style="margin-right: 59px;" for="title">Category Title : </label>
				<input type="text"  name="cat_name" id="cat_name" class="input_box own_input" size="30" value="<?php echo !empty($object->cat_name) ? $object->cat_name : '' ; ?>" spellcheck="true" required/>
			</p>
			<p style="font-size:16px;">
				<input type="checkbox" name="marquee_check" id="marquee_check" onclick="marquee_che()"  value="<?php echo !empty($object->marquee_check) ? $object->marquee_check : ''; ?>" <?php echo $check; ?>>Check to enable <b>Marquee property</b> on your notification category.
			</p>
			
			<div id="marquee_select" <?php echo $style; ?>>
				<p>	
					<label class="input_label" style="margin-right: 21px;" id="" for="title">Marquee Direction : </label>
					<select name="direction" class="input_box own_input" id="direction" onchange="marquee_property_select();">
						<option>inactive</option>
						<option value="up" <?php echo $object->marquee_direction =="up" ? "selected" :"" ?>>up</option>
						<option value="down" <?php echo $object->marquee_direction =="down" ? "selected" :"" ?>>down</option>
						<option value="left" <?php echo $object->marquee_direction =="left" ? "selected" :"" ?>>left</option>
						<option value="right" <?php echo $object->marquee_direction =="right" ? "selected" :"" ?>>right</option>
					</select>
				</p>
				<div id="marquee_property_div" <?php echo $style_marquee_property; ?>>
					<p>
						<label class="input_label" style="margin-right: 45px;" id="" for="title">Marquee Width : </label>
						<input type="text"  name="marquee_width" placeholder="Ex. 100px or 20%" id="marquee_width" class="input_box own_input" value="<?php echo !empty($object->marquee_width) ? $object->marquee_width : '' ; ?>" size="10"/>&nbsp;pixels or %
					</p>
					<p>
						<label class="input_label" id=""  style="margin-right: 40px;" for="title">Marquee Height : </label>
						<input type="text"  name="marquee_height" placeholder="Ex. 100px OR 20%" id="marquee_height" class="input_box own_input" value="<?php echo !empty($object->marquee_height) ? $object->marquee_height : '' ; ?>" size="10"/>&nbsp;pixels or %
					</p>
					<p>
						<label class="input_label" style="margin-right: 10px;" id="" for="title">Marquee Scrolldelay : </label>
						<input type="text"  name="marquee_scrolldelay" placeholder="Ex. 100" id="marquee_scrolldelay" class="input_box own_input" value="<?php echo !empty($object->marquee_scrolldelay) ? $object->marquee_scrolldelay : '' ; ?>" size="10"/>&nbsp;seconds
					</p>
				</div>	
			</div>	
			<input type="submit"class="button button-primary button-large" name="Submit" value="Update Category" />					
			<?php } }?>	
        </form>
    </div>
<?php } ?>