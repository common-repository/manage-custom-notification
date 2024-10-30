function cat_insert_form_valid_check()
{
	if(document.getElementById('cat_name').value.trim()=="")
	{
		document.getElementById('cat_name').style.border="1px solid #dc8a8a";
		return false;
	}
}
function marquee_che()
{
	if(document.getElementById('marquee_check').checked==true)
	{
		document.getElementById('marquee_select').style.display="block";
		document.getElementById('marquee_check').value=1;
	}
	else
	{
		document.getElementById('marquee_select').style.display="none";
		document.getElementById('marquee_check').value=0;
		document.getElementById("direction").selectedIndex = 0;
		
	}
}

function marquee_property_select()
{
	if(document.getElementById("direction").selectedIndex == 0)
	{
		document.getElementById('marquee_property_div').style.display="none";
		document.getElementById('marquee_width').value=null;
		document.getElementById('marquee_height').value=null;
		document.getElementById('marquee_scrolldelay').value=null;
	}
	else
	{
		document.getElementById('marquee_property_div').style.display="block";
	}
}
function how_many_cat()
{
	var checkedValue = ""; 
	var inputElements = document.getElementsByClassName('delete_check_class');
	for(var i=0; inputElements[i]; ++i)
	{
      	if(inputElements[i].checked)
      	{
           checkedValue += inputElements[i].value +",";
      	}
	}
	document.getElementById('category_id').value=checkedValue;
	document.getElementById("delete_cat_form").submit();
}
function all_check_top_cat()
{
	if(document.getElementById('root_checkbox_id_top').checked==true)
	{
		document.getElementById('root_checkbox_id_bottom').checked=true;
		var inputElements = document.getElementsByClassName('delete_check_class');
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=true;
		}
	}
	else
	{
		document.getElementById('root_checkbox_id_bottom').checked=false;
		var inputElements = document.getElementsByClassName('delete_check_class');
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=false;
		}
	}
}
function all_check_bottom_cat()
{
	if(document.getElementById('root_checkbox_id_bottom').checked==true)
	{
		document.getElementById('root_checkbox_id_top').checked=true;
		var inputElements = document.getElementsByClassName('delete_check_class');
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=true;
		}
	}
	else
	{
		document.getElementById('root_checkbox_id_top').checked=false;
		var inputElements = document.getElementsByClassName('delete_check_class');
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=false;
		}
	}
}
function each_check_cat(which_id)
{
	var inputElements = document.getElementsByClassName('delete_check_class');
	if(document.getElementById('root_checkbox_id_top').checked==true || document.getElementById('root_checkbox_id_bottom').checked==true)
	{
		document.getElementById('root_checkbox_id_top').checked=false;
		document.getElementById('root_checkbox_id_bottom').checked=false;
		for(var i=0; inputElements[i]; ++i)
		{
			inputElements[i].checked=true;
			if(inputElements[i].value==which_id)
			{
				inputElements[i].checked=false;
			}		
		}
	}
}