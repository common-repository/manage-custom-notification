<?php
defined('ABSPATH') or die("restricted access");
function mcn_category_insert_data()
{
global $current_user;
if(!mcn_check_current_user_level())
{
	wp_die( __('<h2>You do not have enough permissions to access this page.</h2>') );
}
?>
	<div class="wrap">
        <h1>Add New Notification Category <a href="<?php echo admin_url('admin.php?page=category-list'); ?>" class="page-title-action" role="button">Notification Category</a></h1>
        <p>If you have any type of query releted to Alert customization then please contact with query to <b>rupamhazra@gmail.com</b></p>
        <form name="cat_insert_form" method="post" action="<?php echo get_admin_url().'admin-post.php'; ?>" onsubmit="return cat_insert_form_valid_check()" novalidate>    
			<?php wp_nonce_field( 'cn_cat_in_verify' ); ?>
            <input type="hidden" name="action" value="submit-cat-insert-form-data" />  			
			<p>
				<label class="input_label" style="margin-right: 59px;" for="title">Category Title : </label>
				<input type="text"  name="cat_name" id="cat_name" class="input_box own_input" size="30" spellcheck="true"/>
			</p>
			<p style="font-size:16px;">
				<input type="checkbox" name="marquee_check" id="marquee_check" onclick="marquee_che()"  value="0">Check to enable <b>Marquee property</b> on your notification category.
			</p>	
			<div id="marquee_select" style="display:none;">
				<p>
					<label class="input_label" style="margin-right: 21px;" id="" for="title">Marquee Direction : </label>
					<select name="direction" class="input_box own_input" id="direction" onchange="marquee_property_select();">
						<option>inactive</option>
						<option value="up">up</option>
						<option value="down">down</option>
						<option value="left">left</option>
						<option value="right">right</option>
					</select>
				</p>
				<div id="marquee_property_div" style="display:none;">
					<p>
						<label class="input_label" style="margin-right: 45px;" id="" for="title">Marquee Width : </label>
						<input type="text" placeholder="Ex. 100px or 20%"  name="marquee_width" id="marquee_width" class="input_box own_input"/>&nbsp;pixels or %

					</p>
					<p>
						<label class="input_label" id="" style="margin-right: 40px;" for="title">Marquee Height : </label>
						<input type="text" placeholder="Ex. 100px or 20%" name="marquee_height" id="marquee_height" class="input_box own_input" />&nbsp;pixels or %
					</p>
					<p>
						<label class="input_label" style="margin-right: 10px;" id="" for="title">Marquee Scrolldelay : </label>
						<input type="text"   name="marquee_scrolldelay" id="marquee_scrolldelay" placeholder="Ex. 100" class="input_box own_input" />&nbsp;seconds
					</p>
				</div>
			</div>
			<input type="submit"class="button button-primary button-large" name="Submit" value="Save Category" />					
				<p><b>If this plugin is usefull for you then please rate it.</b></p>	
        </form>
    </div>
<?php } ?>
